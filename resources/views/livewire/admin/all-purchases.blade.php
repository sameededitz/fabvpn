<div>
      <!--breadcrumb-->
      <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Fab VPN</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Purchases</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('create-purchase') }}"><button class="btn btn-light px-5">Create</button></a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12">
            <h6 class="mb-0 text-uppercase">Purchases</h6>
            <hr />
            <div class="card">
                <div class="d-flex justify-content-between">
                    <select class="form-select form-select-dropdown mb-3" aria-label="Default select example">
                        <option value="1">5</option>
                        <option value="2">10</option>
                        <option value="3">15</option>
                    </select>
                    <input type="text" class="form-control table-search search-control" placeholder="Type to search...">
                </div>
                <div class="card-body">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Amount Paid</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>Mark</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation form-pagination">
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
                </nav>
            </div>
        </div>
    </div>
</div>
