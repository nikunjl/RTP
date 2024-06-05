@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }} /</span> Create
</h4>
<div class="row">
    @include('admin.commonmessage')
    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.role.form')
    </form>
</div>
@endsection