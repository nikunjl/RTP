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
    <h4 class="py-1 mb-1">
        <a href="{{ route('products.create') }}" class="btn btn-primary text-right">Add New</a>
    </h4>

    <div class="card-datatable table-responsive pt-0 text-nowrap">

        <table class="datatables-basic table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Description</th>
                    <th>Category</th>
                    <th>Product Image</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(isset($product) && count($product) > 0)
                @foreach($product as $cat)
                @if(!empty($cat->id))
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->code }}</td>
                    <td>{{ $cat->description }}</td>
                    <td>{{ $cat->category_name }}</td>
                    <td>
                        <?php $product_images = App\Models\ProductImage::select('name')->where('product_id', $cat->id)->get(); ?>
                        @if(!empty($product_images))
                        <?php $dd = array_column($product_images->toArray(),'name'); ?>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            @foreach($dd as $vsd)
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $vsd }}">
                                <img src="{{ $vsd }}" alt="{{ $vsd }}" class="rounded-circle">
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </td>
                    <td>
                        <span class="badge rounded-pill bg-label-primary me-1"> {{ ucfirst($cat->gender) }}</span>
                    </td>
                    <td>
                        @if($cat->status == 1)

                        <span class="badge rounded-pill bg-label-primary me-1">Active</span>

                        @else

                        <span class="badge rounded-pill bg-label-danger me-1">In-Active</span>

                        @endif
                    </td>
                    
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('products.edit',[$cat->id]) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <form action="{{ route('products.destroy',[$cat->id]) }}" method="POST">

                                    @method('DELETE')

                                    @csrf

                                    <button class="dropdown-item" onclick="return confirm('Are you sure you want to delete this recored?');" class="mdi mdi-trash-can-outline me-1"><i class="mdi mdi-trash-can-outline me-1"></i>Delete</button>

                                </form>
                                
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection