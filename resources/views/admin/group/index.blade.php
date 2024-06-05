@extends('layouts/contentNavbarLayout')

@section('title',$title)

{{-- @include('admin.datatable') --}}

@section('page-script')
<script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>

<script type="text/javascript">
    var html = '';
    var i = 0;
    $(document).on('click', '.addmore', function() {
        html = `<div class="row" id="myTableRow_${i}">
                <div class="col-md-6 form-floating form-floating-outline mb-4" >
                    <input required type="text" name="name[]" class="form-control searchKeywords" id="basic-default-holiday" placeholder="Name" value="{{ $holiday->name ?? old('name') }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="col-md-6" >
                    <button type="button" onclick="return removeDelete(${i})" class="btn btn-danger remove">Delete</button>
                </div>
            </div>`;
        i++;
        $('#admin_datatable_group').append(html);
    });

    function removeDelete(id) {
        $("#myTableRow_" + id).remove();
    }

    $('#login_form').on('click', function(e) {
         
        var name_map = [];
        $("input[type=text]").each(function() {
            var ss = $(this).val().split(",");
            $.each(ss,function(index,val){
                if(val !== '') {
                    name_map.push(val);
                }
            });
        })

        allVals = [];
        var allok = 0;
        $.each(name_map,function(i,s) {
           if(jQuery.inArray(s, allVals) == -1) {
             allVals.push(s); 
           } else {
              allok++;
           }
        });

        if($("#product_code_val").val() === '') {
            return false;
        } else {
            if(allok !== 0) {
                e.preventDefault();
                $('.showdiveerro').show();
                return false;
            } else {
                $("#login_form_vals").submit();
            }
        }
    });
  
</script>

@endsection

@section('content')
<div class="alert alert-danger showdiveerro" role="alert" style="display: none;">
    <div class="alert-body"><strong>Error : Duplicate value found!</strong></div>
</div>
<h4 class="py-1 mb-1">
    <span class="text-muted fw-light">{{$title}} </span>
</h4>
@include('admin.commonmessage')
<div class="card">
    <form action="{{ route('groups.store') }}" id="login_form_vals" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 form-floating form-floating-outline mb-4">
                                <input type="text" required name="name" class="form-control" id="basic-default-holiday" placeholder="Name" value="" required="" />
                                <label for="basic-default-fullname">Name</label>
                                @error('name')
                                <strong style="color: red;">{{ $message }}</strong>
                                @enderror
                            </div>   
                            <div class="col-md-6 form-floating form-floating-outline mb-4">
                                <input type="text" required name="product_code" class="form-control searchKeywords" id="product_code_val" placeholder="Group" value="" required />
                                <label for="basic-default-fullname">Group</label>
                                @error('product_code')
                                <strong style="color: red;">{{ $message }}</strong>
                                @enderror
                            </div>   
                        </div>

                        <!-- <div id="admin_datatable_group"></div> -->

                        <!-- <a href="javascript::void(0);" class="btn btn-primary addmore mb-3">Add New</a>                     -->

                        <hr />
                        <button type="button" id="login_form" class="btn btn-primary">Save</button>
                        <a href="{{ route('groups.index') }}" class="btn btn-primary">Cancel</a>
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
                    <th>group</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if(count($group) > 0)
                @foreach($group as $k => $rol)
                <tr>
                    <td>{{ $k+1 }}</td>
                    <td>{{ $rol->name }}</td>                    
                    <td>{{ $rol->product_code }}</td>                    
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('groups.edit',[$rol->id]) }}"><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <form action="{{ route('groups.destroy',[$rol->id]) }}" method="POST">
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