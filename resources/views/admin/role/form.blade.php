<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-category" placeholder="Name" value="{{ $category->name ?? '' }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <!-- <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Status</label>
                    <select id="defaultSelect" name="status" class="form-select">
                        <option value="1" @if(isset($category->status) && $category->status == '1') selected="selected" @endif>Action</option>
                        <option value="0" @if(isset($category->status) && $category->status == '0') selected="selected" @endif>Inactive</option>
                    </select>
                </div> -->

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="row">
                        <strong>Permission:</strong>
                        @if(!empty($permission))
                        @php $module = ''; @endphp
                        @foreach($permission as $value)
                        @if($module != $value->module_name )
                        <div class="divider text-start">
                            <div class="divider-text"><strong>{{ $value->module_name  }}</strong></div>
                        </div>
                        @php $module = $value->module_name @endphp
                        @endif
                        <div class="col-md-2">
                            <label>
                                <input type="checkbox" name="permission[]" value="{{ $value->id ?? 0 }}" @if(isset($rolePermissions) && in_array($value->id, $rolePermissions)) ? checked : false @endif />
                                {{ $value->name }}
                            </label>
                        </div>
                        <br />
                        @endforeach
                        @endif
                    </div>
                </div>


                <button type="submit" class="btn btn-primary mt-5">Send</button>
                <a href="{{ route('roles.index') }}" class="btn btn-primary mt-5">Cancel</a>
            </div>
        </div>
    </div>
</div>