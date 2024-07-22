@extends('layout.master')

@section('main-content')
<div class="container">
    <br />
    <h1 class="text-center">Đăng Ký</h1>
    <div class="row vertical-offset">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Thông tin</h3>
                </div>
                <div class="panel-body">
                    <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.registerSubmit') }}">
                        @csrf
                        <fieldset>
                            <div class=" form-group">
                                <label for="username">Tên</label>
                                <input class="form-control" placeholder="Nhập tên người dùng" name="name" value="{{(old('name'))}}" type="text">
                                @if ($errors->has('name'))
                                <span class="error-message" style="color: red;">* {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option value="nam">Nam</option>
                                    <option value="nữ">Nữ</option>
                                    <option value="khác">Khác</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Ngày sinh</label>
                                <input type="date" class="form-control" placeholder="Nhập ngày sinh" name="birthday" value="{{(old('birthday'))}}">
                            </div>
                            <div class="form-group">
                                <label for="username">SĐT</label>
                                <input class="form-control" placeholder="Nhập SĐT" name="phone" value="{{(old('phone'))}}" type="text">
                            </div>
                            <div class="form-group">
                                <label for="username">Mô tả</label>
                                <input class="form-control" placeholder="Mô tả vài điều về bản thân" name="description" value="{{(old('description'))}}" type="text">
                            </div>
                            <div class="form-group">
                                <label for="username">Email</label>
                                <input class="form-control" placeholder="Nhập Email" name="email" value="{{(old('email'))}}" type="text">
                                @if ($errors->has('email'))
                                <span class="error-message" style="color: red;">* {{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập Pasword" name="password">
                                @if ($errors->has('password'))
                                <span class="error-message" style="color: red;">* {{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nhập lại Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập lại Pasword" name="repassword">
                                @if ($errors->has('repassword'))
                                <span class="error-message" style="color: red;">* {{ $errors->first('repassword') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <br />
                                <label for="address" class="control-label">Chọn Thành Phố - Quận/Huyện - Phường/Xã</label>
                                <br />
                                <select name="city" id="province" class="form-control">
                                    <option value="">Chọn Thành phố/Tỉnh</option>
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
                                <label for="inputTitle" class="col-form-label">Đường/Số nhà</label>
                                <input id="street" type="text" name="street" value="{{old('street')}}" id="street" class="form-control"><br />
                                <label for="inputTitle" class="col-form-label">Địa chỉ</label>
                                <input type="text" name="address" id="address" class="form-control rounded-0 text-center" value="{{old('address')}}">
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Đăng ký"><br />
                            <h5 class="text-center"><a href="/login" class="text-left">Đăng nhập</a></h5>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    console.log('adada');
    $(document).ready(function() {
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
                        $('#ward').empty(); 
                        $('#district').append('<option value="">Chọn quận/huyện</option>');
                        $('#address').val(data.province_name); 
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
                        $('#ward').append('<option value="">Chọn phường/xã</option>');
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