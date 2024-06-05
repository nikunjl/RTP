@extends('layouts/contentNavbarLayout')

@section('title', $title)

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
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">{{ $title }} /</span> Edit
</h4>
@include('admin.commonmessage')
<div class="row">
    <form action="{{ route('groups.update',$group->id) }}" id="login_form_vals" method="POST" enctype="multipart/form-data">
        @csrf

        @method('PUT')

        @include('admin.group.form')

    </form>
</div>
@endsection