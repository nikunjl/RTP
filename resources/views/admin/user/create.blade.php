@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('vendor-style')
<link rel="stylesheet" href="{{asset('select2.css')}}">
<link rel="stylesheet" href="{{asset('assets/dropzone.min.css')}}">
@endsection

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
<script src="{{asset('select2.js')}}"></script>
<script src="{{asset('forms-selects.js')}}"></script>
<script src="{{asset('assets/dropzone.min.js')}}"></script>
<script src="{{asset('forms-file-upload.js')}}"></script>

@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }} /</span> Create
</h4>
<div class="row">
    @include('admin.commonmessage')
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.user.form')
    </form>
</div>
@endsection