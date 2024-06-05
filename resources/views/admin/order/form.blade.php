<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <div class="col-12">
                    <div id="dropzone_id" class="fallback dropzone mt-3 ml-2">
                    </div>
                </div>

                <div class="row mt-2 mb-1">
                    @if(!empty($product_images))
                    @foreach($product_images as $k => $vas)
                    <input type="hidden" name="old_img[]" value="{{ $vas->name ?? '' }}" />
                    <div class="col-md-6 col-xl-2 showimage_{{ $k }}">
                        <div class="card mb-3">
                            <img class="card-img-top" src="{{ $vas->name }}">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="btn btn-danger" onclick="return removeImage('{{ $k }}','{{ $vas->id }}','{{ $vas->name }}')" href="javascript::void(0);"> Delete </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="name" class="form-control" id="basic-default-name" placeholder="Product Name" value="{{ $product->name ?? old('name') }}" />
                    <label for="basic-default-fullname">Name</label>
                    @error('name')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="code" class="form-control" id="basic-default-code" placeholder="Product Code" value="{{ $product->code ?? old('code') }}" />
                    <label for="basic-default-fullname">Product Code</label>
                    @error('code')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Product Description">{{ $product->description ?? old('description') }}</textarea>
                    <label for="description">Product Description</label>
                    @error('description')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="categoryselect2Primary" name="category_id" class="select2 form-select">
                                <option value="" selected="selected">Select Category</option>
                                @if(!empty($category))
                                @foreach($category as $catesss)
                                @if(isset($product->category_id) && $product->category_id == $catesss->id)
                                <option value="{{ $catesss->id }}" selected="selected">{{ $catesss->name }}</option>
                                @else
                                <option value="{{ $catesss->id }}">{{ $catesss->name }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="categoryselect2Primary">Category</label>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="sub_category_id" name="sub_category_id" class="select2 form-select">
                                <option value="">Select Sub Category</option>                                
                            </select>
                        </div>
                        <label for="sub_category_id">Sub Category</label>
                    </div>
                </div>
                <div class="col-md-12 mb-4">
                    <!-- <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="select2Primary" name="karat_id[]" class="select2 form-select" multiple>
                                @if(!empty($karat))
                                @foreach($karat as $kat)
                                @if(isset($product->karat_id) && in_array($kat->id,explode(",",$product->karat_id)))
                                <option value="{{ $kat->id }}" selected="selected">{{ $kat->name }}</option>
                                @else
                                <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="select2Primary">Karat</label>
                    </div> -->

		          <small class="text-light fw-medium d-block">Karat</small>
		            @if(!empty($karat))
                        @foreach($karat as $kat)
                    		<?php $checked = ''; ?>
                        	@if(isset($product->karat_id) && in_array($kat->id,explode(",",$product->karat_id)))
							<?php $checked = 'checked'; ?>
                        	@endif
					        <div class="form-check form-check-inline mt-3">
					            <input class="form-check-input" name="karat_id[]" type="checkbox" id="inlineCheckbox1" value="{{ $kat->id }}" {{ $checked }} />
					            <label class="form-check-label" for="inlineCheckbox1">{{ $kat->name }}</label>
					        </div>	
                    	@endforeach		          
		          	@endif
			          
                </div>
                <div class="col-md-12 mb-4">
                    <!-- <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="sizeselect2Primary" name="size_id[]" class="select2 form-select" multiple>
                                @if(!empty($size))
                                @foreach($size as $siz)
                                @if(isset($product->size_id) && in_array($siz->id,explode(",",$product->size_id)))
                                <option value="{{ $siz->id }}" selected="selected">{{ $siz->name }}</option>
                                @else
                                <option value="{{ $siz->id }}">{{ $siz->name }}</option>
                                @endif
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <label for="sizeselect2Primary">Size</label>
                    </div> -->

                    <small class="text-light fw-medium d-block">Size</small>
		            @if(!empty($size))
                        @foreach($size as $siz)
                    		<?php $checked = ''; ?>
                        	@if(isset($product->size_id) && in_array($siz->id,explode(",",$product->size_id)))
							<?php $checked = 'checked'; ?>
                        	@endif
					        <div class="form-check form-check-inline mt-3">
					            <input class="form-check-input" name="size_id[]" type="checkbox" id="size_id" value="{{ $siz->id }}" {{ $checked }} />
					            <label class="form-check-label" for="size_id">{{ $siz->name }}</label>
					        </div>	
                    	@endforeach		          
		          	@endif
                </div>

                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="genderselect2Primary" class="select2 form-select" name="gender">
                                <option value="male" @if(isset($product->gender) && $product->gender == 'male') @endif>Male</option>
                                <option value="female" @if(isset($product->gender) && $product->gender == 'female') @endif>Female</option>
                                <option value="other" @if(isset($product->gender) && $product->gender == 'other') @endif>Other</option>
                            </select>
                        </div>
                        <label for="genderselect2Primary">Gender</label>
                    </div>
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="gross" class="form-control withdecimal" id="gross" placeholder="Gross weight" value="{{ $product->gross ?? old('gross') }}" />
                    <label for="basic-default-fullname">Gross weight</label>
                    @error('gross')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="net" class="form-control withdecimal" id="net" placeholder="Net weight" value="{{ $product->net ?? old('net') }}" />
                    <label for="basic-default-fullname">Net weight</label>
                    @error('net')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating form-floating-outline mb-4">
                    <input type="text" name="stone" class="form-control withdecimal" id="stone" placeholder="Stone" value="{{ $product->stone ?? old('stone') }}" />
                    <label for="basic-default-fullname">Stone</label>
                    @error('stone')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="col-md-12 mb-4">
		          <!-- <small class="text-light fw-medium d-block">Normal people Category Stcok</small> -->
		          <div class="form-check form-check-inline mt-3">
		            <input class="form-check-input" type="radio" name="normal_category" id="normal_category" value="1" @if(isset($product->normal_category) && $product->normal_category == '1') checked @endif checked />
		            <label class="form-check-label" for="normal_category">Normal people Category Stcok</label>
		          </div>
		          <div class="form-check form-check-inline mt-3">
		            <input class="form-check-input" type="radio" name="normal_category" id="normal_category_no" value="2" @if(isset($product->normal_category) && $product->normal_category == '2') checked @endif />
		            <label class="form-check-label" for="normal_category_no">People Show Actual Category Stcok (grant access)</label>
		          </div>			          
		        </div>
		        
                <!-- <div class="form-floating form-floating-outline mb-4">
                    <input type="number" name="normal_category" class="form-control withdecimal" id="normal_category" placeholder="normal_category weight" value="{{ $product->normal_category ?? old('normal_category') }}" />
                    <label for="basic-default-fullname">Normal people Category Stcok</label>
                    @error('normal_category')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div> -->

                <!-- <div class="col-md-12 mb-4">
		          <small class="text-light fw-medium d-block">People Show Actual Category Stcok (grant access)</small>
		          <div class="form-check form-check-inline mt-3">
		            <input class="form-check-input" type="radio" name="show_actual_category" id="show_actual_category" value="1" @if(isset($product->show_actual_category) && $product->show_actual_category == '1') checked @endif />
		            <label class="form-check-label" for="show_actual_category">Yes</label>
		          </div>
		          <div class="form-check form-check-inline mt-3">
		            <input class="form-check-input" type="radio" name="show_actual_category" id="show_actual_category_no" value="0" @if(isset($product->show_actual_category) && $product->show_actual_category == '0') checked @endif />
		            <label class="form-check-label" for="show_actual_category_no">No</label>
		          </div>			          
		        </div> -->

                <!--  <div class="form-floating form-floating-outline mb-4">
                    <input type="number" name="show_actual_category" class="form-control withdecimal" id="show_actual_category" placeholder="People Show Actual Category Stcok (grant access)" value="{{ $product->show_actual_category ?? old('show_actual_category') }}" />
                    <label for="basic-default-fullname">People Show Actual Category Stcok (grant access)</label>
                    @error('show_actual_category')
                    <strong style="color: red;">{{ $message }}</strong>
                    @enderror
                </div> -->
                <!-- <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="catesselect2Primary" name="normal_category" class="select2 form-select">
                                <option value="1" @if(isset($product->normal_category) && $product->normal_category == '1') selected="selected" @endif>Yes</option>
                                <option value="0" @if(isset($product->normal_category) && $product->normal_category == '0') selected="selected" @endif>No</option>
                            </select>
                        </div>
                        <label for="catesselect2Primary"></label>
                    </div>
                </div> -->

               <!--  <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="showsselect2Primary" name="show_actual_category" class="select2 form-select">
                                <option value="1" @if(isset($product->show_actual_category) && $product->show_actual_category == '1') selected="selected" @endif>Yes</option>
                                <option value="0" @if(isset($product->show_actual_category) && $product->show_actual_category == '0') selected="selected" @endif>No</option>
                            </select>
                        </div>
                        <label for="showsselect2Primary">People Show Actual Category Stcok (grant access)</label>
                    </div>
                </div> -->

                <div class="col-md-12 mb-4">
                    <div class="form-floating form-floating-outline">
                        <div class="select2-primary">
                            <select id="statusselect2Primary" name="status" class="select2 form-select">
                                <option value="1" @if(isset($product->status) && $product->status == '1') selected="selected" @endif>Action</option>
                                <option value="0" @if(isset($product->status) && $product->status == '0') selected="selected" @endif>Inactive</option>
                            </select>
                        </div>
                        <label for="statusselect2Primary">Status</label>
                    </div>
                </div>

                <hr />
                <div class=" mb-3">
                    <div class="editcats mb-3">
                        <h4 class="mb-sm-0 font-size-16">Material Details</h4>

                        <table id="admin_datatable" class="table table-bordered dt-responsive  nowrap w-100">

                            <head>
                                <tr>
                                    <th>Name</th>
                                    <th>Weight</th>
                                    <th>Total Rupees</th>
                                    <th>-</th>
                                </tr>
                            </head>
                            @if(!empty($material))

                            <body>
                                @foreach($material as $s => $sd)
                                <tr id="myTableRow_{{ $s }}">
                                    <td>
                                        <input type="text" name="matname[]" value="{{ $sd->name ?? '' }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="matweight[]" value="{{ $sd->weight ?? '' }}" class="form-control withdecimal">
                                    </td>
                                    <td>
                                        <input type="text" name="matrs[]" value="{{ $sd->rs ?? '' }}" class="form-control withdecimal">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove_{{ $k }} " onclick="return removeDelete('{{ $s }}')">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </body>

                            @endif
                        </table>
                    </div>
                </div>
                <hr />
                <a href="javascript::void(0);" class="btn btn-primary addmore mb-3">Add New</a>
                <hr />

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Cancel</a>
            </div>
        </div>
    </div>
</div>