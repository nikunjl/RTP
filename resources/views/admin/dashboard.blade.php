@extends('layouts/contentNavbarLayout')



@section('title', $title)

@include('admin.datatable')

@section('vendor-style')

<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">

<!-- <link rel="stylesheet" href="{{asset('datatable/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/datatables.checkboxes.css')}}"> -->

@endsection



@section('vendor-script')

<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

@endsection



@section('page-script')

<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>

<!-- <script src="{{asset('datatable/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('datatable/tables-datatables-basic.js')}}"></script> -->

@endsection





@section('content')

<div class="row gy-4">



    <!-- Sales by Countries -->

<!--     <div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="datatables-basic table table-bordered">
      <thead>
        <tr>
          <th></th>
          <th></th>
          <th>id</th>
          <th>Name</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td></td>
            <td></td>
            <td>12</td>
            <td>asdasd</td>
            <td>asdasdda@aas</td>
          </tr>
           <tr>
            <td></td>
            <td></td>
            <td>ss</td>
            <td>ss</td>
            <td>ss@aas</td>
          </tr>
      </tbody>
    </table>
  </div>
</div> -->

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Customer</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <!-- <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalCustomer ?? 0 }}</h6>

                                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i> -->

                                <!-- <small class="text-success">25.8%</small> -->

                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                   <!--  <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div> -->

                </div>

            </div>

        </div>

    </div>

    <!--/ Sales by Countries -->



    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Category</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                       <!--  <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalCate ?? 0 }}</h6>

                                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i> -->

                                <!-- <small class="text-success">25.8%</small> -->

                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                   <!--  <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div>
 -->
                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Product</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                       <!--  <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalProduct ?? 0 }}</h6>

                               <!--  <i class="mdi mdi-chevron-up mdi-24px text-success"></i>

                                <small class="text-success">25.8%</small>
 -->
                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                    <!-- <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div> -->

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Total order</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                     <!--    <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalOrder ?? 0 }}</h6>

                                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i>

                                <small class="text-success">25.8%</small> -->

                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                 <!--    <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div> -->

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Today Order</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                       <!--  <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalOrderToday ?? 0 }}</h6>

                                <!-- <i class="mdi mdi-chevron-up mdi-24px text-success"></i>

                                <small class="text-success">25.8%</small> -->

                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                   <!--  <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div> -->

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4 col-md-6">

        <div class="card">

            <div class="card-header d-flex align-items-center justify-content-between">

                <h5 class="card-title m-0 me-2">Grant User Request</h5>

            </div>

            <div class="card-body">

                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

                    <div class="d-flex align-items-center">

                        <!-- <div class="avatar me-3">

                            <div class="avatar-initial bg-label-success rounded-circle">US</div>

                        </div> -->

                        <div>

                            <div class="d-flex align-items-center gap-1">

                                <h6 class="mb-0">{{ $totalgrantaccess ?? 0 }}</h6>

                               <!--  <i class="mdi mdi-chevron-up mdi-24px text-success"></i>

                                <small class="text-success">25.8%</small> -->

                            </div>

                            <!-- <small>United states of america</small> -->

                        </div>

                    </div>

                 <!--    <div class="text-end">

                        <h6 class="mb-0">894k</h6>

                        <small>Sales</small>

                    </div> -->

                </div>

            </div>

        </div>

    </div>



</div>

@endsection