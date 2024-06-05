<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-size" placeholder="Name" value="{{ $size->name ?? old('name') }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Status</label>
                    <select id="defaultSelect" name="status" class="form-select">
                        <option value="1" @if(isset($size->status) && $size->status == '1') selected="selected" @endif>Action</option>
                        <option value="0" @if(isset($size->status) && $size->status == '0') selected="selected" @endif>Inactive</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('sizes.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>