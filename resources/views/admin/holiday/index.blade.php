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
@include('admin.commonmessage')
<div class="card">
    <form action="{{ route('holiday.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="name" class="form-control" id="basic-default-holiday" placeholder="Name" value="" />
                            <label for="basic-default-fullname">Name</label>
                            @error('name')
                            <strong style="color: red;">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="date" name="holiday_date" class="form-control" id="basic-default-holiday" placeholder="Name" value="" />
                            <label for="basic-default-fullname">Name</label>
                            @error('holiday_date')
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
                        <a href="{{ route('holiday.index') }}" class="btn btn-primary">Cancel</a>
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
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(count($holiday) > 0)
                @foreach($holiday as $rol)
                <tr>
                    <td>{{ $rol->id }}</td>
                    <td>{{ $rol->name }}</td>
                    <td>{{ $rol->holiday_date }}</td>
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
                                <a class="dropdown-item" href="{{ route('holiday.edit',[$rol->id]) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <form action="{{ route('holiday.destroy',[$rol->id]) }}" method="POST">

                                    @method('DELETE')

                                    @csrf

                                    <button class="dropdown-item" onclick="return confirm('Are you sure you want to delete this recored?');" class="mdi mdi-trash-can-outline me-1"><i class="mdi mdi-trash-can-outline me-1"></i>Delete</button>

                                </form>
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