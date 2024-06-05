<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="User Name" value="{{ $user->name ?? old('name') }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="email" name="email" class="form-control" id="basic-default-code" placeholder="Email" value="{{ $user->email ?? old('email') }}" />
                    <label for="basic-default-fullname">Email</label>
                    @error('email')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="mobile_no" class="form-control withdecimal" id="basic-default-code" placeholder="Mobile No" value="{{ $user->mobile_no ?? old('mobile_no') }}" maxlength="10" />
                    <label for="basic-default-fullname">Mobile No</label>
                    @error('mobile_no')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <!-- <div class="form-floating form-floating-outline mb-4">
                    <input type="password" name="password" class="form-control" id="basic-default-code" placeholder="*******" value="{{ $user->password ?? old('password') }}" />
                    <label for="basic-default-fullname">Password</label>
                    @error('password')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div> -->
                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="categoryselect2Primary" name="role" class="select2 form-select">
                                <option value="" selected="selected">Select Role</option>
                                @if(!empty($rols))
                                @foreach($rols as $catesss)
                                @if(isset($user->role) && $user->role == $catesss->id)
                                <option value="{{ $catesss->id }}" selected="selected">{{ $catesss->name }}</option>
                                @else
                                <option value="{{ $catesss->id }}">{{ $catesss->name }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="categoryselect2Primary">Role</label>
                    </div>
                    @error('role')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>                

               <!--  <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="genderselect2Primary" class="select2 form-select" name="gender">
                                <option value="male" @if(isset($user->gender) && $user->gender == 'male') @endif>Male</option>
                                <option value="female" @if(isset($user->gender) && $user->gender == 'female') @endif>Female</option>
                                <option value="other" @if(isset($user->gender) && $user->gender == 'other') @endif>Other</option>
                            </select>
                        </div>
                        <label for="genderselect2Primary">Gender</label>
                    </div>
                </div> -->

                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="statusselect2Primary" name="status" class="select2 form-select">
                                <option value="1" @if(isset($user->status) && $user->status == '1') selected="selected" @endif>Action</option>
                                <option value="0" @if(isset($user->status) && $user->status == '0') selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                        <label for="statusselect2Primary">Status</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('user.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>