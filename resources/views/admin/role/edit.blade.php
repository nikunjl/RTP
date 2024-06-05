@extends('layouts/contentNavbarLayout')

@section('title', $title)

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }} /</span> Edit
</h4>

<div class="row">
    <form action="{{ route('roles.update',$category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @include('admin.role.form')

    </form>
</div>
@endsection