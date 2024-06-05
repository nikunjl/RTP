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
    <form action="{{ route('karat.update',$karat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @include('admin.karat.form')

    </form>
</div>
@endsection