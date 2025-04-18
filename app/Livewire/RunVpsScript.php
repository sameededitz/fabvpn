<?php

namespace App\Livewire;

use Livewire\Component;
use phpseclib3\Net\SSH2;
use phpseclib3\Net\SFTP;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RunVpsScript extends Component
{


    public $ssh_host;
    public $ssh_username;
    public $ssh_password;
    public $vpn_domain;
    public $vpn_email;
    
    public $output = '';
    public $isRunning = false;
    public $success = false;
    public $error = '';

    protected $rules = [
        'ssh_host' => 'required|string',
        'ssh_username' => 'required|string',
        'ssh_password' => 'required|string',
        'vpn_domain' => 'required|string',
        'vpn_email' => 'required|email',
    ];

    public function mount()
    {
        // Default values if needed
        $this->vpn_domain = "in.appapistec.xyz";
        $this->vpn_email = "vpn@appapistec.xyz";
    }

    public function runScript()
    {
        $this->validate();
        
        $this->isRunning = true;
        $this->output = '';
        $this->error = '';
        $this->success = false;
        
        try {
            // Get the modified script content directly as string
            $scriptContent = $this->getModifiedScript();
            
            $this->appendOutput("Connecting to server {$this->ssh_host}...\n");
            
            // Create SFTP connection for file upload
            $sftp = new SFTP($this->ssh_host);
            if (!$sftp->login($this->ssh_username, $this->ssh_password)) {
                throw new \Exception("SFTP login failed. Please check your credentials.");
            }
            
            $this->appendOutput("Connected successfully via SFTP!\n");
            $this->appendOutput("Uploading setup script...\n");
            
            // Upload the script to the server
            $remoteScriptPath = '/tmp/vpn_setup_' . time() . '.sh';
            if (!$sftp->put($remoteScriptPath, $scriptContent)) {
                throw new \Exception("Failed to upload script to the server.");
            }
            
            // Close SFTP connection
            $sftp = null;
            
            // Create a new SSH connection for execution
            $ssh = new SSH2($this->ssh_host);
            if (!$ssh->login($this->ssh_username, $this->ssh_password)) {
                throw new \Exception("SSH login failed. Please check your credentials.");
            }
            
            $this->appendOutput("Connected successfully via SSH!\n");
            $this->appendOutput("Making script executable...\n");
            
            // Make the script executable
            $ssh->exec("chmod +x {$remoteScriptPath}");
            
            // Execute the script
            $this->appendOutput("\n=== Starting VPN Setup Script ===\n\n");
            
            // Execute the script with a separate connection to avoid channel conflicts
            // Create a method to capture and handle script output in chunks
            $ssh->setTimeout(600); // 10 minutes timeout
            
            // We'll use the exec method instead of enablePTY which can cause issues
            $result = $ssh->exec("bash {$remoteScriptPath}");
            $this->appendOutput($result);
            
            // Clean up the temporary script
            $ssh->exec("rm {$remoteScriptPath}");
            
            // Close SSH connection
            $ssh = null;
            
            $this->success = true;
            $this->appendOutput("\n=== VPN Setup Completed Successfully ===\n");
            
        } catch (\Exception $e) {
            $this->error = 'Error: ' . $e->getMessage();
            $this->appendOutput("ERROR: " . $e->getMessage());
            Log::error('VPN Script execution failed', ['error' => $e->getMessage()]);
        } finally {
            $this->isRunning = false;
        }
    }
    
    private function appendOutput($text)
    {
        $this->output .= $text;
        $this->dispatch('outputUpdated');
    }

    private function getModifiedScript()
    {
        // The script as a string variable
        $scriptContent = <<<'SCRIPT'
#!/bin/bash

set -e

# Server IP address - Change this to your server's public IP
SERVER_IP=$(curl -s https://ipinfo.io/ip)
VPN_DOMAIN="in.appapistec.xyz"
EMAIL="vpn@appapistec.xyz"

# Color codes for better readability
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored text
print_color() {
    printf "${2}%s${NC}\n" "$1"
}

print_color "Starting IKEv2 VPN deployment..." $BLUE
print_color "Server IP: $SERVER_IP" $YELLOW
print_color "Date: $(date -u '+%Y-%m-%d %H:%M:%S')" $YELLOW

# Update system
print_color "Updating system packages..." $YELLOW
apt-get update && apt-get upgrade -y

# Install required packages
print_color "Installing StrongSwan and required packages..." $YELLOW
apt-get install -y certbot strongswan strongswan-pki libcharon-extra-plugins libcharon-extauth-plugins libstrongswan-extra-plugins

# Create strongswan.conf with correct syntax
print_color "Creating StrongSwan configuration..." $YELLOW
cat > /etc/strongswan.conf << EOF
charon {
    load_modular = yes
    duplicheck {
        enable = no
    }
    compress = yes
    plugins {
        include strongswan.d/charon/*.conf
    }
    # DNS servers
    dns1 = 1.1.1.1
    dns2 = 8.8.8.8
    
    # Fix for IP assignment issues
    install_virtual_ip = yes
    install_virtual_ip_on = yes
}

include strongswan.d/*.conf
EOF

# Disable TPM plugin to avoid warnings
if [ -f "/etc/strongswan.d/charon/tpm.conf" ]; then
    print_color "Disabling TPM plugin..." $YELLOW
    cat > /etc/strongswan.d/charon/tpm.conf << EOF
tpm {
    load = no
}
EOF
fi

# Obtain SSL certificate from Let's Encrypt
print_color "Obtaining SSL certificate from Let's Encrypt..." $YELLOW
certbot certonly --standalone --preferred-challenges http --non-interactive --agree-tos --email "${EMAIL}" -d "${VPN_DOMAIN}"

#while [ $? -ne 0 ]; do
#    print_color "Certbot command failed. Retrying..." $RED
#    certbot certonly --standalone --preferred-challenges http --non-interactive --agree-tos --email "${EMAIL}" -d "${VPN_DOMAIN}"
#done

# Copy the certificates to the appropriate StrongSwan directories
print_color "Copying certificates to /etc/ipsec.d/..." $YELLOW
cp /etc/letsencrypt/live/${VPN_DOMAIN}/fullchain.pem /etc/ipsec.d/certs/
cp /etc/letsencrypt/live/${VPN_DOMAIN}/chain.pem /etc/ipsec.d/cacerts/
cp /etc/letsencrypt/live/${VPN_DOMAIN}/privkey.pem /etc/ipsec.d/private/

# Set correct permissions for the certificates
chmod 644 /etc/ipsec.d/certs/fullchain.pem
chmod 644 /etc/ipsec.d/cacerts/chain.pem
chmod 600 /etc/ipsec.d/private/privkey.pem

# Configure StrongSwan
print_color "Configuring IPsec..." $YELLOW

# Create ipsec.conf
cat > /etc/ipsec.conf << EOF
config setup
    charondebug="ike 2, knl 2, cfg 2, net 2, esp 2, dmn 2, mgr 2"
    uniqueids=yes

conn %default
    keyexchange=ikev2
    ike=aes256-sha2_256-modp2048,aes128-sha2_256-modp2048,aes256-sha1-modp2048,aes128-sha1-modp2048
    esp=aes256-sha2_256,aes128-sha2_256,aes256-sha1,aes128-sha1
    dpdaction=clear
    dpddelay=300s
    rekey=no
    left=%any
    leftsubnet=0.0.0.0/0
    leftcert=fullchain.pem
    right=%any
    rightdns=1.1.1.1,8.8.8.8

conn ikev2-vpn
    leftid=${VPN_DOMAIN}
    leftsendcert=always
    rightauth=eap-mschapv2
    eap_identity=%any
    rightsourceip=10.10.10.0/24
    auto=add
EOF

# Create ipsec.secrets
cat > /etc/ipsec.secrets << EOF
: ECDSA privkey.pem
EOF

# Enable IP forwarding
print_color "Enabling IP forwarding..." $YELLOW
echo 'net.ipv4.ip_forward = 1' | tee -a /etc/sysctl.conf
echo 'net.ipv6.conf.all.forwarding = 1' | tee -a /etc/sysctl.conf
sysctl -p

# Setup firewall rules
print_color "Configuring firewall rules..." $YELLOW
apt-get install -y iptables-persistent

# Save current iptables rules
iptables-save > /etc/iptables/rules.v4
ip6tables-save > /etc/iptables/rules.v6

# Determine default interface
DEFAULT_INTERFACE=$(ip route | grep default | awk '{print $5}')
if [ -z "$DEFAULT_INTERFACE" ]; then
    DEFAULT_INTERFACE=$(ip link | grep -v lo | head -n 1 | cut -d: -f2 | tr -d ' ')
    print_color "Warning: Couldn't detect default interface, using $DEFAULT_INTERFACE" $RED
else
    print_color "Detected default interface: $DEFAULT_INTERFACE" $GREEN
fi

# Configure iptables rules
iptables -A INPUT -p udp --dport 500 -j ACCEPT
iptables -A INPUT -p udp --dport 4500 -j ACCEPT
iptables -A FORWARD -m state --state RELATED,ESTABLISHED -j ACCEPT
iptables -A FORWARD -s 10.10.10.0/24 -j ACCEPT
iptables -t nat -A POSTROUTING -s 10.10.10.0/24 -o $DEFAULT_INTERFACE -j MASQUERADE

# Save new iptables rules
iptables-save > /etc/iptables/rules.v4

# Add VPN users - Function to add users
add_vpn_user() {
    local username="$1"
    local password="$2"
    echo "${username} : EAP \"${password}\"" >> /etc/ipsec.secrets
    echo "Added user: ${username}"
}

# Add a default user
print_color "Adding default VPN user..." $YELLOW
add_vpn_user "vpnuser" "StrongP@ssw0rd"

# Creating user management script
cat > /usr/local/bin/manage-vpn-users << 'EOL'
#!/bin/bash

VPN_SECRETS="/etc/ipsec.secrets"

add_user() {
    if [[ -z "$1" || -z "$2" ]]; then
        echo "Usage: $0 add <username> <password>"
        return 1
    fi
    
    local username="$1"
    local password="$2"
    
    # Check if username already exists
    if grep -q "^$username :" "$VPN_SECRETS"; then
        echo "User $username already exists"
        return 1
    fi
    
    echo "$username : EAP \"$password\"" >> "$VPN_SECRETS"
    echo "User $username added successfully"
    
    # Restart strongSwan to apply changes
    sudo ipsec rereadsecrets
    sudo ipsec update

}

delete_user() {
    if [[ -z "$1" ]]; then
        echo "Usage: $0 delete <username>"
        return 1
    fi
    
    local username="$1"
    
    # Check if username exists
    if ! grep -q "^$username :" "$VPN_SECRETS"; then
        echo "User $username does not exist"
        return 1
    fi
    
    # Create a temporary file
    local temp_file=$(mktemp)
    grep -v "^$username :" "$VPN_SECRETS" > "$temp_file"
    cat "$temp_file" > "$VPN_SECRETS"
    rm -f "$temp_file"
    
    echo "User $username deleted successfully"
    
    # Restart strongSwan to apply changes
    sudo ipsec rereadsecrets
    sudo ipsec update
}

list_users() {
    grep " : EAP " "$VPN_SECRETS" | cut -d' ' -f1
}

case "$1" in
    add)
        add_user "$2" "$3"
        ;;
    delete)
        delete_user "$2"
        ;;
    list)
        list_users
        ;;
    *)
        echo "Usage: $0 {add|delete|list}"
        echo "  add <username> <password> - Add a new VPN user"
        echo "  delete <username>         - Delete a VPN user"
        echo "  list                      - List all VPN users"
        exit 1
        ;;
esac
EOL

chmod +x /usr/local/bin/manage-vpn-users

# Restart StrongSwan
print_color "Restarting StrongSwan..." $YELLOW
systemctl restart strongswan-starter
systemctl enable strongswan-starter

# Generate a random UUID for the configuration files
generate_uuid() {
    cat /proc/sys/kernel/random/uuid 2>/dev/null || echo "$(date +%s)-$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | head -c 8)"
}

# Create iOS mobileconfig
print_color "Creating iOS .mobileconfig file..." $YELLOW

UUID1=$(generate_uuid)
UUID2=$(generate_uuid)
UUID3=$(generate_uuid)

cat > ~/vpn-ios.mobileconfig << EOF
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
    <key>PayloadContent</key>
    <array>
        <dict>
            <key>IKEv2</key>
            <dict>
                <key>AuthenticationMethod</key>
                <string>Username</string>
                <key>ChildSecurityAssociationParameters</key>
                <dict>
                    <key>EncryptionAlgorithm</key>
                    <string>AES-256-GCM</string>
                    <key>IntegrityAlgorithm</key>
                    <string>SHA2-256</string>
                    <key>DiffieHellmanGroup</key>
                    <integer>14</integer>
                    <key>LifeTimeInMinutes</key>
                    <integer>1440</integer>
                </dict>
                <key>DeadPeerDetectionRate</key>
                <string>Medium</string>
                <key>DisableMOBIKE</key>
                <integer>0</integer>
                <key>DisableRedirect</key>
                <integer>0</integer>
                <key>EnableCertificateRevocationCheck</key>
                <integer>0</integer>
                <key>EnablePFS</key>
                <integer>0</integer>
                <key>ExtendedAuthEnabled</key>
                <integer>1</integer>
                <key>IKESecurityAssociationParameters</key>
                <dict>
                    <key>EncryptionAlgorithm</key>
                    <string>AES-256-GCM</string>
                    <key>IntegrityAlgorithm</key>
                    <string>SHA2-256</string>
                    <key>DiffieHellmanGroup</key>
                    <integer>14</integer>
                    <key>LifeTimeInMinutes</key>
                    <integer>1440</integer>
                </dict>
                <key>RemoteAddress</key>
                <string>${SERVER_IP}</string>
                <key>RemoteIdentifier</key>
                <string>${VPN_DOMAIN}</string>
                <key>UseConfigurationAttributeInternalIPSubnet</key>
                <integer>0</integer>
                <key>ServerCertificateIssuerCommonName</key>
                <string>VPN CA</string>
            </dict>
            <key>IPv4</key>
            <dict>
                <key>OverridePrimary</key>
                <integer>1</integer>
            </dict>
            <key>PayloadDescription</key>
            <string>Configures VPN settings</string>
            <key>PayloadDisplayName</key>
            <string>VPN</string>
            <key>PayloadIdentifier</key>
            <string>com.apple.vpn.managed.${UUID1}</string>
            <key>PayloadType</key>
            <string>com.apple.vpn.managed</string>
            <key>PayloadUUID</key>
            <string>${UUID2}</string>
            <key>PayloadVersion</key>
            <integer>1</integer>
            <key>Proxies</key>
            <dict>
                <key>HTTPEnable</key>
                <integer>0</integer>
                <key>HTTPSEnable</key>
                <integer>0</integer>
            </dict>
            <key>UserDefinedName</key>
            <string>VPN (${SERVER_IP})</string>
            <key>VPNType</key>
            <string>IKEv2</string>
        </dict>
    </array>
    <key>PayloadDisplayName</key>
    <string>IKEv2 VPN Configuration</string>
    <key>PayloadIdentifier</key>
    <string>com.example.vpn.${UUID3}</string>
    <key>PayloadRemovalDisallowed</key>
    <false/>
    <key>PayloadType</key>
    <string>Configuration</string>
    <key>PayloadUUID</key>
    <string>${UUID3}</string>
    <key>PayloadVersion</key>
    <integer>1</integer>
</dict>
</plist>
EOF

# Create instructions for Android
cat > ~/vpn-android-instructions.txt << EOF
# Android VPN Setup Instructions

## Required Information:
- Server Address: ${SERVER_IP}
- VPN Type: IKEv2
- Username: vpnuser (or your created username)
- Password: StrongP@ssw0rd (or your created password)

## Setup Instructions:

1. Open Settings on your Android device
2. Go to "Network & Internet" or "Connections"
3. Select "VPN" and tap on "+" or "Add VPN"
4. Fill in the following information:
   - Name: IKEv2 VPN
   - Type: IKEv2/IPSec MSCHAPv2
   - Server address: ${SERVER_IP}
   - IPSec identifier: ${VPN_DOMAIN}
   - Username: vpnuser
   - Password: StrongP@ssw0rd

5. Save the VPN configuration
6. Connect to the VPN by tapping on the newly created profile

## Notes:
- Some Android devices might have slightly different menu options
- If your device doesn't support IKEv2 natively, you can use the StrongSwan app from Google Play Store
- For StrongSwan app, use the same server, username and password but select "IKEv2 EAP" as the VPN Type
EOF

# Create instructions for using StrongSwan Android app
cat > ~/vpn-strongswan-android-instructions.txt << EOF
# StrongSwan Android App Setup Instructions

If your Android device doesn't natively support IKEv2 VPN, follow these steps to use the StrongSwan app:

1. Download and install "StrongSwan VPN Client" from Google Play Store

2. Open the StrongSwan app and tap "Add VPN Profile"

3. Fill in the following information:
   - Server: ${SERVER_IP}
   - VPN Type: IKEv2 EAP (Username/Password)
   - Username: vpnuser (or your created username)
   - Password: StrongP@ssw0rd (or your created password)
   
4. In the "Advanced Settings" section:
   - Check "Use RSA/PSK" settings
   - Set "RSA/PSK Identity" to "${VPN_DOMAIN}"
   - Leave Certificate Selection as "Auto"

5. Save the profile

6. Connect to the VPN by tapping on the newly created profile

The StrongSwan app offers better compatibility with IKEv2 on older Android versions (before Android 10).
EOF

# Create troubleshooting guide
cat > ~/vpn-troubleshooting.txt << EOF
# IKEv2 VPN Troubleshooting Guide

## Common Issues and Solutions

### Connection Drops Frequently

1. Check if your ISP or mobile carrier blocks VPN traffic
2. Try using different ports (modify ipsec.conf)
3. Check system logs: \journalctl -u strongswan-starter\

### Cannot Connect

1. Check if ports 500 and 4500 are open:
   \iptables -L -n | grep -E "500|4500"\
   
2. Verify StrongSwan is running:
   \systemctl status strongswan-starter\
   
3. Check for certificate issues:
   \ipsec listcerts\

### Slow Connection

1. Try different encryption settings in ipsec.conf
2. Your server might be overloaded, check system resources:
   \htop\ or \top\
   
### DNS Issues

1. Check DNS settings in strongswan.conf
2. Try alternative DNS servers like 8.8.8.8 and 8.8.4.4

## Server Maintenance

### Restart VPN Service
\systemctl restart strongswan-starter\

### Update Server 
\apt update && apt upgrade\

### Check Active Connections
\ipsec statusall\

### Monitor Real-time Logs
\journalctl -u strongswan-starter -f\

## Security Recommendations

1. Change default VPN password
2. Regularly update your server
3. Consider setting up fail2ban to protect against brute-force attacks
4. Review system logs periodically
EOF

# Create a backup script
cat > /usr/local/bin/backup-vpn-config << 'EOF'
#!/bin/bash
# Script to backup VPN configuration files

BACKUP_DIR="/root/vpn-backups"
TIMESTAMP=$(date +"%Y-%m-%d_%H-%M-%S")
BACKUP_FILE="vpn-backup-$TIMESTAMP.tar.gz"

mkdir -p $BACKUP_DIR

# Create backup
tar -czf $BACKUP_DIR/$BACKUP_FILE /etc/ipsec.* /etc/strongswan.* /etc/ipsec.d /usr/local/bin/manage-vpn-users

echo "Backup created: $BACKUP_DIR/$BACKUP_FILE"
echo "Content: IPsec and StrongSwan configuration files"

# Keep only the 5 most recent backups
ls -t $BACKUP_DIR/vpn-backup-* | tail -n +6 | xargs rm -f
EOF

chmod +x /usr/local/bin/backup-vpn-config

# Create a cron job for automatic backups
echo "0 3 * * 0 /usr/local/bin/backup-vpn-config > /dev/null 2>&1" | crontab -

print_color "Setup complete!" $GREEN
print_color "Default VPN user: vpnuser" $GREEN
print_color "Default password: StrongP@ssw0rd" $GREEN
print_color "\nTo manage VPN users, use:" $BLUE
print_color "  /usr/local/bin/manage-vpn-users add <username> <password>" $BLUE
print_color "  /usr/local/bin/manage-vpn-users delete <username>" $BLUE
print_color "  /usr/local/bin/manage-vpn-users list" $BLUE

print_color "\niOS configuration file created at: ~/vpn-ios.mobileconfig" $GREEN
print_color "Android instructions created at: ~/vpn-android-instructions.txt" $GREEN
print_color "StrongSwan Android app instructions created at: ~/vpn-strongswan-android-instructions.txt" $GREEN
print_color "Troubleshooting guide created at: ~/vpn-troubleshooting.txt" $GREEN

print_color "\nAutomatic weekly backups of your VPN configuration will be created in /root/vpn-backups" $GREEN

print_color "\nTo check if StrongSwan is running properly:" $BLUE
print_color "  systemctl status strongswan-starter" $BLUE

print_color "\nTo view connection logs:" $BLUE
print_color "  journalctl -u strongswan-starter" $BLUE

print_color "\nTo manually backup your VPN configuration:" $BLUE
print_color "  /usr/local/bin/backup-vpn-config" $BLUE

print_color "\nVPN Server deployment completed successfully at $(date -u '+%Y-%m-%d %H:%M:%S')" $GREEN
print_color "You can now connect from your devices using the provided configuration files and instructions." $GREEN
SCRIPT;

        // Replace the variables with user-provided values
        $scriptContent = str_replace('VPN_DOMAIN="in.appapistec.xyz"', 'VPN_DOMAIN="' . $this->vpn_domain . '"', $scriptContent);
        $scriptContent = str_replace('EMAIL="vpn@appapistec.xyz"', 'EMAIL="' . $this->vpn_email . '"', $scriptContent);
        
        return $scriptContent;
    }

    public function render()
    {
        return view('livewire.run-vps-script')
        ->extends('layouts.app')
        ->section('content');
    }
}











