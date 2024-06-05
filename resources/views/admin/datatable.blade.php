@section('vendor-style')

<link rel="stylesheet" href="{{asset('datatable/datatables.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/responsive.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/buttons.bootstrap5.css')}}">
<link rel="stylesheet" href="{{asset('datatable/datatables.checkboxes.css')}}">

@endsection


@section('page-script')

<script src="{{asset('datatable/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('datatable/tables-datatables-basic.js')}}"></script>

@endsection