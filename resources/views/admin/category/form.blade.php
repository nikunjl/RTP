<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-category" placeholder="Category name" value="{{ $category->name ?? '' }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Category Description">{{ $category->description ?? '' }}</textarea>
                    <label for="description">Category Description</label>
                    @error('description')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image">
                    @error('image')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                    <input type="hidden" name="old_img" value="{{ $category->img ?? '' }}" />
                </div>
                <div class="mb-3">
                    @if(!empty($category->img))
                    <img src="{{ asset('category/'.$category->img) }}" style="height: 50px;width:100px;">
                    @endif
                </div>
                <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Status</label>
                    <select id="defaultSelect" name="status" class="form-select">
                        <option value="1" @if(isset($category->status) && $category->status == '1') selected="selected" @endif>Action</option>
                        <option value="0" @if(isset($category->status) && $category->status == '0') selected="selected" @endif>Inactive</option>
                    </select>
                </div>
                <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Parent Category</label>
                    <select id="defaultSelect" name="parent_category" class="form-select">
                        <option value="">Select parent Category</option>
                        @if(count($catArray) > 0)
                        @foreach($catArray as $k => $sa)
                        @if(isset($category->parent_category) && $category->parent_category == $sa['id'])
                        <option value="{{ $sa['id'] }}" selected>{{ $sa['name'] }}</option>
                        @else
                        <option value="{{ $sa['id'] }}">{{ $sa['name'] }}</option>
                        @endif
                        @endforeach
                        @endif
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('categorys.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>