<div>
    // resources/views/admin/vpn-deployment.blade.php    
    @section('title', 'VPN Deployment')
    
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @livewire('run-vpn-script')
            </div>
        </div>
    </div>
    @endsection
</div>
