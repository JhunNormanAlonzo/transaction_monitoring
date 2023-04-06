<div class="col-xxl-4 col-md-4">
    <div class="card info-card revenue-card">
        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" style="cursor: pointer;" wire:click="all">All</a></li>
                <li><a class="dropdown-item" style="cursor: pointer;" wire:click="today">Today</a></li>
                <li><a class="dropdown-item" style="cursor: pointer;" wire:click="month">This Month</a></li>
                <li><a class="dropdown-item" style="cursor: pointer;" wire:click="year" >This Year</a></li>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Send Load <span>| {{$filterTag}}</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cash"></i>
                </div>
                <div class="ps-3">
                    <h6>{{number_format(abs($send_load), 2)}}</h6>
                    {{--                                        <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>--}}
                </div>
            </div>
        </div>

    </div>
</div><!-- End Revenue Card -->
