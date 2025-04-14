@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0">Revenue</p>
                        <h4 class="my-1">$4805</h4>
                        <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week
                        </p>
                    </div>
                    <div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
                    </div>
                </div>
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0">Total Customers</p>
                        <h4 class="my-1">8.4K</h4>
                        <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week
                        </p>
                    </div>
                    <div class="widgets-icons ms-auto"><i class='bx bxs-group'></i>
                    </div>
                </div>
                <div id="chart2"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0">Purchases</p>
                        <h4 class="my-1">59K</h4>
                        <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last
                            week</p>
                    </div>
                    <div class="widgets-icons ms-auto"><i class='bx bxs-binoculars'></i>
                    </div>
                </div>
                <div id="chart3"></div>
            </div>
        </div>
    </div>
</div>
<!--end row-->
<!--end row-->
<div class="row">
    <div class="col-xl-6 d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Transaction History</h5>
                        <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>in last 30 days revenue</p>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"> <i
                                class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table align-middle mb-0 table-hover" id="Transaction-History">
                        <thead class="table-light">
                            <tr>
                                <th>Payment Name</th>
                                <th>Date & Time</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Payment from Michle Jhon</h6>
                                            <p class="mb-0 font-13">Refrence Id #8547846</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jan 10, 2021</td>
                                <td>+256.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Payment from Pauline Bird</h6>
                                            <p class="mb-0 font-13">Refrence Id #9653248</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jan 12, 2021</td>
                                <td>+566.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Payment from Ralph Alva</h6>
                                            <p class="mb-0 font-13">Refrence Id #7689524</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jan 14, 2021</td>
                                <td>+636.00</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="">
                                        </div>
                                        <div class="ms-2">
                                            <h6 class="mb-1 font-14">Payment from John Roman</h6>
                                            <p class="mb-0 font-13">Refrence Id #8335884</p>
                                        </div>
                                    </div>
                                </td>
                                <td>Jan 15, 2021</td>
                                <td>+246.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="col-12 col-xl-11 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">New Customers</h5>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                                <i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="customers-list p-3 mb-3">
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Emy Jackson</h6>
                            <p class="mb-0 font-13">emy_jac@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Martin Hughes</h6>
                            <p class="mb-0 font-13">martin.hug@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Laura Madison</h6>
                            <p class="mb-0 font-13">laura_01@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Shoan Stephen</h6>
                            <p class="mb-0 font-13">s.stephen@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Keate Medona</h6>
                            <p class="mb-0 font-13">Keate@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Paul Benn</h6>
                            <p class="mb-0 font-13">pauly.b@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Alister Campel</h6>
                            <p class="mb-0 font-13">alister_42@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto"> <a href="javascript:;"
                                class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i
                                    class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->
<div class="row row-cols-1 row-cols-lg-3">
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Top Categories</h5>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5" id="chart15"></div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                    Kids <span class="badge bg-light-white-2 rounded-pill">25</span>
                </li>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                    Women <span class="badge bg-light-white-3 rounded-pill">10</span>
                </li>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                    Men <span class="badge bg-white rounded-pill text-dark">65</span>
                </li>
                <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                    Furniture <span class="badge bg-light-white-4 text-white rounded-pill">14</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-body">
                <p class="font-weight-bold mb-1">Visitors</p>
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="mb-0">43,540</h4>
                    </div>
                    <div class="">
                        <p class="mb-0 align-self-center font-weight-bold ms-2">4.4 <i
                                class='bx bxs-up-arrow-alt mr-2'></i>
                        </p>
                    </div>
                </div>
                <div id="chart21"></div>
            </div>
        </div>
    </div>
    <div class="col d-flex">
        <div class="card radius-10 w-100 overflow-hidden">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Sales Overiew</h5>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                            <i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:;">Action</a>
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Another action</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-5" id="chart20"></div>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <div class="d-flex align-items-center justify-content-between text-center">
                    <div>
                        <h6 class="mb-1 font-weight-bold">$289.42</h6>
                        <p class="mb-0">Last Week</p>
                    </div>
                    <div class="mb-1">
                        <h6 class="mb-1 font-weight-bold">$856.14</h6>
                        <p class="mb-0">Last Month</p>
                    </div>
                    <div>
                        <h6 class="mb-1 font-weight-bold">$987,25</h6>
                        <p class="mb-0">Last Year</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
