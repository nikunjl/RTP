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

<script type="text/javascript">

    var html = '';

    var i = '';

    <?php if (!empty($product->id)) { ?>

        i = '{{ $product->id }}'

    <?php } else { ?>

        var i = 0;

    <?php } ?>

    $(document).on('click', '.addmore', function() {

        html = `            

            <tr id="myTableRow_${i}">

                    <td>

                        <input type="text" name="matname[]"  class="form-control">

                    </td>

                    <td>

                        <input type="text" name="matweight[]"  class="form-control withdecimal">

                    </td>

                    <td>

                        <input type="text" name="matrs[]"  class="form-control withdecimal">

                    </td>

                    <td>

                        <button type="button" onclick="return removeDelete(${i})" class="btn btn-danger remove">Delete</button>

                    </td>

                </tr>

            `;

        $('#admin_datatable tr:last').after(html);

        // $(".editcats").append(html);

    });



    $(function() {

        $('.withdecimal').on('input', function(e) {

            if (/^(\d+(\.\d{0,3})?)?$/.test($(this).val())) {

                // Input is OK. Remember this value

                $(this).data('prevValue', $(this).val());

            } else {

                // Input is not OK. Restore previous value

                $(this).val($(this).data('prevValue') || '');

            }

        }).trigger('input');

    });



    var myDropzone = new Dropzone("#dropzone_id", {

        addRemoveLinks: true,

        url: "#",

        maxFiles: 100,

        accept: function(file) {

            let fileReader = new FileReader();

            fileReader.readAsDataURL(file);

            fileReader.onloadend = function() {

                let content = fileReader.result;

                $('#dropzone_id').append('<input type="hidden" class="cimages" name="image[]" value="' + content + '">');

                file.previewElement.classList.add("dz-success");

            }

            file.previewElement.classList.add("dz-complete");

        }

    });



    function removeImage(id, main_id, name) {

        $.ajax({

            type: "GET",

            async: false,

            url: "{{ route('deleteImage') }}",

            data: {

                "id": main_id,

                "name": name

            },

            success: function(result) {

                window.location.reload();

            },

            failure: function(response) {},

            error: function(response) {}

        });

        $(".showimage_" + main_id).remove();

    }



    function removeDelete(id) {

        $("#myTableRow_" + id).remove();

    }
    @if(!empty($product->sub_category_id)) 
        chnageCategory('{{ $product['category_id'] }}');
    @endif

    $(document).on('change',"#categoryselect2Primary",function() {
        chnageCategory($(this).val());
    });

    function chnageCategory(ids) 
    {
         $.ajax({
            url: "{{ route('getsubcate') }}",
            type: "GET",
            data: {
               "id":ids
            },
            cache: false,
            success: function(data) {
                var html = '';
                $('#sub_category_id').html("");
                $.each(data, function(key, value) {
                    html = `<option value="${value.id}">${value.name}</option>`;
                });
                $('#sub_category_id').append(html);                    
            },
            error: function(err, result) {
                // alert("Error" + err.responseText);
            }
        });
    }

</script>

@endsection



@section('content')

<h4 class="py-3 mb-4">

    <span class="text-muted fw-light">{{ $title }} /</span> Create

</h4>



<div class="row">

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">

        @csrf



        @method('PUT')



        @include('admin.product.form')



    </form>

</div>

@endsection