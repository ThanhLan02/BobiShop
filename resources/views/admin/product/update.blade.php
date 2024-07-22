@extends('admin.layout.master')

@section('main-content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Product Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Update Product</h5>
            <div class="card-body">
                <form method="post" action="{{route('admin.productdoupdate',$product->id)}}">
                @csrf 
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="name" placeholder="{{$product->name}}" value="{{$product->name}}" class="form-control">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image" value="{{$base_url}}{{$product->image}}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;">
                            <img src="{{$product->image}}" alt="" style="margin-top:15px;max-height:100px;">
                        </div>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach($categories as $key)
                                <option value='{{$key->id}}' {{(($product->category_id==$key->id)? 'selected' : '')}}>{{$key->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="brand_id">Brand <span class="text-danger">*</span></label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">--Select any brand--</option>
                            @foreach($brands as $key)
                                <option value='{{$key->id}}' {{(($product->brand_id==$key->id)? 'selected' : '')}}>{{$key->name}}</option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" placeholder="Write something" id="description" name="description">{{$product->description}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="condition">Condition</label>
                        <select name="condition" class="form-control">
                            <option value="">--Select Condition--</option>
                            <option value="default" {{(($product->condition=='default')? 'selected':'')}}>Default</option>
                            <option value="new" {{(($product->condition=='new')? 'selected':'')}}>New</option>
                            <option value="hot" {{(($product->condition=='hot')? 'selected':'')}}>Hot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity <span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="quantity" min="0" placeholder="Enter quantity" value="{{$product->quantity}}" class="form-control">
                        @error('quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100" placeholder="Enter discount" value="{{$product->discount}}" class="form-control">
                        @error('discount')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="old_price" class="col-form-label">Price (VNĐ)</label>
                        <input id="old_price" type="number" name="old_price" min="0" placeholder="Enter price" value="{{$product->old_price}}" class="form-control">
                    </div>
                    <input id="new_price" type="number" name="new_price" min="0" placeholder="Enter price" value="0" class="form-control" style="display: none;">
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="active" {{(($product->status=='active')? 'selected':'')}}>Active</option>
                            <option value="inactive" {{(($product->status=='inactive')? 'selected':'')}}>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#lfm').filemanager('image');
</script>
@endpush