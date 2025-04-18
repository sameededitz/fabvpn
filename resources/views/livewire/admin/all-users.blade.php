<div>
    @if (session('message'))
        <x-alert type="success" :message="session('message')" />
    @endif
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fab VPN</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('create-user') }}"><button class="btn btn-light px-5">Create</button></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">Users</h6>
            <hr />
            <div class="card">
                <div class="d-flex justify-content-between">
                    <select class="form-select form-select-dropdown mb-3" wire:model.live="perPage"
                        aria-label="Default select example">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                        <option value="30">30</option>
                    </select>
                    <input type="text" wire:model.live="search" class="form-control table-search search-control"
                        placeholder="Type to search...">
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Last Login</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->activePlan ? $user->activePlan->plan->name : 'Free' }}</td>
                                    <td>{{ $user->last_login ? $user->last_login->diffForHumans() : 'Never' }}</td>
                                    <td>{{ $user->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a href="{{ route('edit-user', $user->id) }}"
                                            class="btn btn-primary">Edit</a>
                                            <button class="btn btn-danger"
                                              wire:click="$js.confirmDelete({{ $user->id }})">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $users->links('components.pagination', data: ['scrollTo' => false]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        $js('confirmDelete', (id) => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $wire.deleteUser(id)
                }
            })
        })

        $wire.on('sweetAlert', (event) => {
            Swal.fire({
                icon: event.type,
                title: event.title,
                text: event.message,
                showConfirmButton: false,
                timer: 1500
            })
        })
    </script>
    @endscript
