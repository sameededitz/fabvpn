@section('title', 'Manage User')
<div>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Home</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Users</li>
                    <li class="breadcrumb-item active" aria-current="page">Manage</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="row">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 mb-3 order-1 order-md-2">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Personal Info</h5>
                </div>
                <div class="card-body">
                    <ul class="ps-0 fs-6 mb-0">
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <p class="w-30 fw-semibold text-primary-light">Full Name</p>
                            <p class="w-70 fw-normal">: {{ $user->name }} </p>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <p class="w-30 text-md fw-semibold text-primary-light"> Email</p>
                            <p class="w-70 text-secondary-light fw-normal">: {{ $user->email }} </p>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <p class="w-30 text-md fw-semibold text-primary-light"> Role</p>
                            <p class="w-70 text-secondary-light fw-normal">: {{ Str::title($user->role) }}
                            </p>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <p class="w-30 text-md fw-semibold text-primary-light"> Last Login</p>
                            <p class="w-70 text-secondary-light fw-normal">:
                                {{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }} </p>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <p class="w-30 text-md fw-semibold text-primary-light mb-0"> Registered</p>
                            <p class="w-70 text-secondary-light fw-normal mb-0">:
                                {{ $user->created_at->toDayDateTimeString() }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
