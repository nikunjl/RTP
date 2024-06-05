@extends('layouts/contentNavbarLayout')

@section('title',$title)

@include('admin.datatable')

@section('vendor-style')

<link rel="stylesheet" href="{{asset('select2.css')}}">

<link rel="stylesheet" href="{{asset('assets/dropzone.min.css')}}">

@endsection

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<script src="{{asset('select2.js')}}"></script>

@endsection

@section('content')
<h4 class="py-1 mb-1">
    <span class="text-muted fw-light">{{$title}} </span>
</h4>
@include('admin.commonmessage')
<div class="card">
    <form action="{{ route('datewise.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-floating form-floating-outline mb-4">
                            <select name="shift_id" class="select2 form-select" id="categoryselect2Primary">
                                <option value="">Select</option>
                                <option value="9to2">9 to 2</option>
                                <option value="2to7">2 to 7</option>
                            </select>         
                            <label for="categoryselect2Primary">Shift Time</label>                   
                            @error('shift_id')
                            <strong style="color: red;">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="number" name="order_take" class="form-control" id="basic-default-order_take" placeholder="How much take order ?" value="" />
                            <label for="basic-default-fullname">How much take order ?</label>
                            @error('order_take')
                            <strong style="color: red;">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" name="shift_date" class="form-control" id="basic-default-holiday" placeholder="Name" value="" />
                            <label for="basic-default-fullname">Date</label>
                            @error('shift_date')
                            <strong style="color: red;">{{ $message }}</strong>
                            @enderror
                        </div>
                        <input type="hidden" name="status" value="1">
                        <!-- <div class=" mb-3">
                            <label for="defaultSelect" class="form-label">Status</label>
                            <select id="defaultSelect" name="status" class="form-select">
                                <option value="1" @if(isset($holiday->status) && $holiday->status == '1') selected="selected" @endif>Action</option>
                                <option value="0" @if(isset($holiday->status) && $holiday->status == '0') selected="selected" @endif>Inactive</option>
                            </select>
                        </div> -->


                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('datewise.index') }}" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="card-datatable table-responsive pt-0 text-nowrap">

        <table class="datatables-basic table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>How much order</th>
                    <th>date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(count($datewise) > 0)
                @foreach($datewise as $rol)
                <tr>
                    <td>{{ $rol->id }}</td>
                    <td>{{ $rol->shift_id }}</td>
                    <td>{{ $rol->order_take }}</td>
                    <td>{{ $rol->shift_date }}</td>
                    <td>
                        @if($rol->status == 1)

                        <span class="badge rounded-pill bg-label-primary me-1">Active</span>

                        @else

                        <span class="badge rounded-pill bg-label-danger me-1">In-Active</span>

                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('datewise.edit',[$rol->id]) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <!-- <form action="{{ route('holiday.destroy',[$rol->id]) }}" method="POST">

                                    @method('DELETE')

                                    @csrf

                                    <button class="dropdown-item" onclick="return confirm('Are you sure you want to delete this recored?');" class="mdi mdi-trash-can-outline me-1"><i class="mdi mdi-trash-can-outline me-1"></i>Delete</button>

                                </form> -->
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection