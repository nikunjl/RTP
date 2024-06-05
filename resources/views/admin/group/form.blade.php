<div class="alert alert-danger showdiveerro" role="alert" style="display: none;">
    <div class="alert-body"><strong>Error : Duplicate value found!</strong></div>
</div>
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-floating form-floating-outline mb-4">
                        <input type="text" required name="name" class="form-control" id="basic-default-holiday" placeholder="Name" value="{{ $group->name ?? old('name') }}" />
                        <label for="basic-default-fullname">Name</label>
                        @error('name')
                        <strong style="color: red;">{{ $message }}</strong>
                        @enderror
                    </div>   
                    <div class="col-md-6 form-floating form-floating-outline mb-4">
                        <input type="text" required name="product_code" class="form-control searchKeywords" id="product_code" placeholder="Group" value="{{ $group->product_code ?? old('product_code') }}" />
                        <label for="basic-default-fullname">Group</label>
                        @error('name')
                        <strong style="color: red;">{{ $message }}</strong>
                        @enderror
                    </div>   
                </div>
                


                <button type="button" id="login_form" class="btn btn-primary">Save</button>
                <a href="{{ route('groups.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>