<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-slider" placeholder="Slider name" value="{{ $slider->name ?? '' }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Slider Description">{{ $slider->description ?? '' }}</textarea>
                    <label for="description"> Description</label>
                    @error('description')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="img" name="img">
                    @error('img')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                    <input type="hidden" name="old_img" value="{{ $slider->img ?? '' }}" />
                </div>
                <div class="mb-3">
                    @if(!empty($slider->img))
                    <img src="{{ asset('slider/'.$slider->img) }}" style="height: 50px;width:100px;">
                    @endif
                </div>
                <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Status</label>
                    <select id="defaultSelect" name="status" class="form-select">
                        <option value="1" @if(isset($slider->status) && $slider->status == '1') selected="selected" @endif>Action</option>
                        <option value="0" @if(isset($slider->status) && $slider->status == '0') selected="selected" @endif>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('sliders.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>