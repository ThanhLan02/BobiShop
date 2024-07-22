@extends('admin.layout.master')

@section('main-content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Brands</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Brand Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Update Brand</h5>
            <div class="card-body">
                <form method="post" action="{{route('admin.branddoupdate',$brand->id)}}">
                @csrf 
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="name" placeholder="{{$brand->name}}" value="{{$brand->name}}" class="form-control">
                        @error('name')
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
