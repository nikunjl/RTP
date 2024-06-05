@extends('layouts/contentNavbarLayout')



@section('title', $title)
@section('vendor-style')
<link rel="stylesheet" href="{{asset('select2.css')}}">
@endsection


@section('page-script')
<script src="{{asset('select2.js')}}"></script>
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>

@endsection



@section('content')

<h4 class="py-3 mb-4">

    <span class="text-muted fw-light">{{ $title }} /</span> Create

</h4>



<div class="row">

    <form action="{{ route('customer.update',$customer->id) }}" method="POST" enctype="multipart/form-data">

        @csrf



        @method('PUT')



        @include('admin.customer.form')



    </form>

</div>

@endsection