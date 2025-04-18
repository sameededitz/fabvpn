<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Deploy VPN Server</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="runScript">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="ssh_host">Server IP Address</label>
                            <input type="text" class="form-control @error('ssh_host') is-invalid @enderror" 
                                   id="ssh_host" wire:model="ssh_host" placeholder="e.g. 123.456.789.0">
                            @error('ssh_host') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="ssh_username">SSH Username</label>
                            <input type="text" class="form-control @error('ssh_username') is-invalid @enderror" 
                                   id="ssh_username" wire:model="ssh_username" placeholder="e.g. root">
                            @error('ssh_username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="ssh_password">SSH Password</label>
                            <input type="password" class="form-control @error('ssh_password') is-invalid @enderror" 
                                   id="ssh_password" wire:model="ssh_password" placeholder="SSH Password">
                            @error('ssh_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <hr>
                <h4>VPN Configuration</h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vpn_domain">VPN Domain</label>
                            <input type="text" class="form-control @error('vpn_domain') is-invalid @enderror" 
                                   id="vpn_domain" wire:model="vpn_domain" placeholder="e.g. vpn.example.com">
                            @error('vpn_domain') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="vpn_email">Email Address</label>
                            <input type="email" class="form-control @error('vpn_email') is-invalid @enderror" 
                                   id="vpn_email" wire:model="vpn_email" placeholder="e.g. admin@example.com">
                            @error('vpn_email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary" 
                            wire:loading.attr="disabled" 
                            {{ $isRunning ? 'disabled' : '' }}>
                        <span wire:loading wire:target="runScript" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ $isRunning ? 'Deploying VPN Server...' : 'Deploy VPN Server' }}
                    </button>
                </div>
                
                @if($success)
                    <div class="alert alert-success mt-3">
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        VPN server has been successfully deployed.
                    </div>
                @endif
                
                @if($error)
                    <div class="alert alert-danger mt-3">
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        {{ $error }}
                    </div>
                @endif
                
                @if(!empty($output))
                    <div class="mt-3">
                        <h5>Script Output:</h5>
                        <div class="card bg-dark text-white">
                            <div class="card-body">
                                <pre id="script-output" style="height: 300px; overflow-y: auto; white-space: pre-wrap;">{{ $output }}</pre>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
    
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('outputUpdated', function () {
                let outputElement = document.getElementById('script-output');
                if (outputElement) {
                    outputElement.scrollTop = outputElement.scrollHeight;
                }
            });
        });
    </script>
</div>
