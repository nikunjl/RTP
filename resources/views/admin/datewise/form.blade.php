@include('admin.commonmessage')
<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <select name="shift_id" class="select2 form-select" id="categoryselect2Primary">
                        <option value="">Select</option>
                        <option value="9to2" @if(isset($datewise->shift_id) && $datewise->shift_id == '9to2') selected="selected" @endif>9 to 2</option>
                        <option value="2to7" @if(isset($datewise->shift_id) && $datewise->shift_id == '2to7') selected="selected" @endif>2 to 7</option>
                    </select>         
                    <label for="categoryselect2Primary">Shift Time</label>                   
                    @error('shift_id')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="number" name="order_take" class="form-control" id="basic-default-order_take" placeholder="How much take order ?" value="{{ $datewise->order_take ?? old('order_take') }}" />
                    <label for="basic-default-fullname">How much take order ?</label>
                    @error('order_take')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="date" name="shift_date" class="form-control" id="basic-default-holiday" placeholder="Name" value="{{ $datewise->shift_date ?? old('shift_date') }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('holiday_date')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <input type="hidden" name="status" value="1"> 
                <!-- <div class=" mb-3">
                    <label for="defaultSelect" class="form-label">Status</label>
                    <select id="defaultSelect" name="status" class="form-select">
                        <option value="1" @if(isset($datewise->status) && $datewise->status == '1') selected="selected" @endif>Action</option>
                        <option value="0" @if(isset($datewise->status) && $datewise->status == '0') selected="selected" @endif>Inactive</option>
                    </select>
                </div> -->


                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('datewise.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>