@extends('layouts/contentNavbarLayout')



@section('title',$title)

@include('admin.datatable')

@section('page-script')

<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>

@endsection



@section('content')

<h4 class="py-1 mb-1">

    <span class="text-muted fw-light">{{$title}} </span>

</h4>

<div class="card">

    <!-- <h4 class="py-1 mb-1">

        <a href="{{ route('categorys.create') }}" class="btn btn-primary text-right">Add New</a>

    </h4> -->



   <div class="card-datatable table-responsive pt-0 text-nowrap">

        <table class="datatables-basic-1234 table table-bordered">

            <thead class="table-light">

                <tr>

                    <th>Id</th>

                    <th>Customer Name</th>

                    <th>Customer location</th>

                    <th>Created At</th>

                    <!-- <th>Status</th> -->

                    <!-- <th>Actions</th> -->

                </tr>

            </thead>

            <tbody class="table-border-bottom-0">

                @if(count($customer) > 0)

                @foreach($customer as $cus)

                <tr>

                    <td>{{ $cus->id }}</td>

                    <td>{{ $cus->name }}</td>

                    <td>{{ $cus->city_name ?? '' }}</td>

                    <td>{{ $cus->created_at }}</td>

                   <!--  <td>

                        @if($cus->status == 1)



                        <span class="badge rounded-pill bg-label-primary me-1">Active</span>



                        @else



                        <span class="badge rounded-pill bg-label-danger me-1">In-Active</span>



                        @endif

                    </td> -->

                   <!--  <td>

                        <div class="dropdown">

                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>

                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="{{ route('customer.edit',[$cus->id]) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>

                                <form action="{{ route('customer.destroy',[$cus->id]) }}" method="POST">



                                    @method('DELETE')



                                    @csrf



                                    <button class="dropdown-item" onclick="return confirm('Are you sure you want to delete this recored?');" class="mdi mdi-trash-can-outline me-1"><i class="mdi mdi-trash-can-outline me-1"></i>Delete</button>



                                </form>

                            </div>

                        </div>

                    </td> -->

                </tr>

                @endforeach

                @endif

            </tbody>

        </table>

    </div>

</div>

@endsection