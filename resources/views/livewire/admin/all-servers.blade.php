<div>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Home</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Servers</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="card-title mb-0">All Servers</h3>
                    <a href="javascript:void(0);">
                        <button type="button" class="btn btn-light btn-outline-primary px-3 radius-30">Create
                            Server</button>
                    </a>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 flex-wrap row-gap-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <select class="form-select form-select-sm" wire:model.live="perPage">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="statusFilter">
                                <option value="" selected>Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="typeFilter">
                                <option value="" selected>Type</option>
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model.live="platformFilter">
                                <option value="" selected>Platform</option>
                                <option value="windows">Windows</option>
                                <option value="macos">Mac</option>
                                <option value="ios">iOS</option>
                                <option value="android">Android</option>
                            </select>
                        </div>
                        <div class="search-input">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Search..."
                                    wire:model.live.500ms="search">
                                <span class="input-group-text" id="basic-addon1">
                                    <Iconify-icon icon="material-symbols-light:search" width="20"
                                        height="20"></Iconify-icon>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
