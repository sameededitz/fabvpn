<div>
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fab VPN</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Plans</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('create-plan') }}"><button class="btn btn-light px-5">Create</button></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 ">
            <h6 class="mb-0 text-uppercase">Plans</h6>
            <hr />
            <div class="card">
                <div class="d-flex justify-content-between">
                    <select class="form-select form-select-dropdown mb-3" wire:model.live="perPage" aria-label="Default select example">
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
                                <th scope="col">Price</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($plans as $plan)
                                <tr>
                                    <th>{{ $plan->id }}</th>
                                    <td>{{ $plan->name }}</td>
                                    <td>{{ $plan->price }}</td>
                                    <td>{{ $plan->duration }} {{ Str::title($plan->duration_unit) }}</td>
                                    <td>{{ $plan->created_at->diffForHumans() }}</td>
                                    <td>
                                        {{-- <a href="{{ route('edit-plan', ['id' => $plan->id]) }}"
                                            class="btn btn-primary">Edit</a> --}}
                                        <button wire:click="deletePlan({{ $plan->id }})"
                                            class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $plans->links('components.pagination', data:['scrollTo' => false]) }}
                    </div>
                </div>
                {{-- <nav aria-label="Page navigation form-pagination">
                    <ul class="pagination round-pagination">
                        <li class="page-item"><a class="page-link" href="javascript:;">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:;javascript:;">1</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="javascript:;">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:;">3</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:;">Next</a>
                        </li>
                    </ul>
                </nav> --}}
            </div>
        </div>
    </div>
</div>
