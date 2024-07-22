@extends('admin.layout.master')

@section('main-content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">User</a></li>
                    <li class="breadcrumb-item active">User Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="card">
            <h5 class="card-header">Add User</h5>
            <div class="card-body">
                <form method="post" action="{{route('admin.usersstore')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="name" placeholder="Enter name" value="{{old('name')}}" class="form-control">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Phone <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="phone" placeholder="Enter phone" value="{{old('phone')}}" class="form-control">
                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Birthday <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="date" name="birthday" value="{{old('birthday')}}" class="form-control">
                        @error('birthday')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">--Select any gender--</option>
                            <option value='nam'>Nam</option>
                            <option value='nữ'>Nữ</option>
                            <option value='khác'>Khác</option>
                        </select>
                        @error('gender')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <br />
                        <label for="address" class="control-label">Address</label>
                        <br />
                        <select name="city" id="province" class="form-control">
                            <option value="">chọn thành phố</option>
                            @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select><br />
                        <select name="district" id="district" class="form-control">
                            <option value="">chọn quận</option>
                        </select><br />
                        <select name="ward" id="ward" class="form-control">
                            <option value="">chọn phường</option>
                        </select>
                        <br />
                        <label for="inputTitle" class="col-form-label">Street <span class="text-danger">*</span></label>
                        <input id="street" type="text" name="street" value="{{old('street')}}" id="street" class="form-control"><br />
                        <input type="text" name="address" id="address" class="form-control rounded-0 text-center" value="{{old('address')}}">
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="image" value="{{old('image')}}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('image')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" placeholder="Write something" id="description" name="description">{{old('description')}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-form-label">Email</label>
                        <input id="inputEmail" type="email" name="email" placeholder="Enter email" value="{{old('email')}}" class="form-control">
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-form-label">Password</label>
                        <input id="inputPassword" type="password" name="password" placeholder="Enter password" value="{{old('password')}}" class="form-control">
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                            <label for="exampleInputEmail1">Repassword</label>
                            <input type="password" class="form-control" placeholder="Nhập lại Pasword" name="repassword">
                            @if ($errors->has('repassword'))
                            <span class="error-message">* {{ $errors->first('repassword') }}</span>
                            @endif
                        </div>
                    <div class="form-group">
                        <label for="role" class="col-form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('role')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
    $(document).ready(function() {
        // AJAX request to get districts based on selected province
        // var address = document.getElementById('address').val();
        $('#province').on('change', function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: '/get-districts/' + province_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        $('#district').empty();
                        $('#ward').empty(); // Xóa danh sách phường/xã khi thay đổi tỉnh/thành phố
                        $('#district').append('<option value="">Select District</option>');
                        $('#address').val(data.province_name); // Hiển thị province_name
                        $.each(data.districts, function(key, value) {
                            $('#district').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#district').empty();
            }
        });

        // AJAX request to get wards based on selected district
        $('#district').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: '/get-wards/' + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('#ward').empty();
                        $('#ward').append('<option value="">Select Ward</option>');
                        $('#address').val(data.district_name + ", " + $('#address').val());
                        $.each(data.wards, function(key, value) {
                            $('#ward').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#ward').empty();
            }
        });

        $('#ward').on('change', function() {
            var ward_id = $(this).val();
            if (ward_id) {
                $.ajax({
                    url: '/get-ward-name/' + ward_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#address').val(data.ward_name + ", " + $('#address').val());
                    }
                });
            } else {
                $('#ward_name_input').val(''); // Đảm bảo làm sạch giá trị khi không có ward được chọn
            }
        });
    });

    $('#street').on('change', function() {
        var newValue = $(this).val();
        $('#address').val(newValue + ", " + $('#address').val());
    });
</script>
@endpush