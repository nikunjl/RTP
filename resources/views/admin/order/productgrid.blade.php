@extends('layouts/contentNavbarLayout')

@section('title',$title)

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
<h4 class="py-1 mb-1">
    <span class="text-muted fw-light">{{$title}} </span>
</h4>
@include('admin.commonmessage')
<div class="row mb-5">

    @if(!empty($products))
    @foreach($products as $cats)
    <div class="col-md-4 col-lg-2">
        <div class="card mb-4">
            <a href="{{ route('products.edit',[$cats->id]) }}" class="card-link">
                @if(!empty($cats->image_name))
                <?php $dd = explode(",", $cats->image_name); ?>
                <img class="card-img-top" src="{{ asset('product/'.$dd[0]) }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <p class="card-text text-center">
                        {{ $cats->name }}
                    </p>
                </div>
                <!-- <div class="card-body text-center">
                    View
                </div> -->
            </a>
        </div>
    </div>
    @endforeach
    @endif

</div>
@endsection