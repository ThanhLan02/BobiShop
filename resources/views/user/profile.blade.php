@extends('layout.master')

@section('main-content')
<div class="container">
    <br />
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                @if($user->image != null)
                                <img src="{{$user->image}}" alt="Maxwell Admin">
                                @else
                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                @endif
                            </div>
                            <h5 class="user-name">{{$user->name}}</h5>
                            <h6 class="user-email">{{$user->email}}</h6>
                        </div>
                        @if($user->description != null)
                        <div class="about">
                            <h5>About</h5>
                            <p>{{$user->description}}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <form method="post" action="{{route('user.updateprofile',Session::get('user'))}}">
                @csrf
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Thông tin cá nhân</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="fullName">Họ Tên</label>
                                    <input type="text" name="name" value="{{$user->name}}" class="form-control" id="fullName" placeholder="Enter full name">
                                    @if ($errors->has('name'))
                                    <span class="error-message">* {{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" name="email" value="{{$user->email}}" class="form-control" id="eMail" placeholder="Enter email ID" readonly>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="phone">SĐT</label>
                                    <input type="text" name="phone" value="{{$user->phone}}" class="form-control" id="phone" placeholder="Enter phone number">
                                    @if ($errors->has('phone'))
                                    <span class="error-message">* {{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" name="birthday" value="{{$user->birthday}}" class="form-control" id="website" placeholder="Website url">
                                    @if ($errors->has('birthday'))
                                    <span class="error-message">* {{ $errors->first('birthday') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="birthday">Mô tả</label>
                                    <textarea style="resize: both;box-sizing: border-box;width: 847px;" name="description" placeholder="Mô tả bản thân" id="txtarea" oninput="autoResize(this)"></textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="gender">Giới tính</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="nam" {{(($user->gender=='nam')? 'selected':'')}}>Nam</option>
                                        <option value="nữ" {{(($user->gender=='nữ')? 'selected':'')}}>Nữ</option>
                                        <option value="khác" {{(($user->gender=='khác')? 'selected':'')}}>Khác</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mt-3 mb-2 text-primary">Địa chỉ</h6>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" id="address" name="address" value="{{$user->address}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Địa chỉ khác</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Chọn địa chỉ khác?
                                </label>
                                <div class="caption">
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
                                        <input id="street" type="text" name="street" value="{{old('street')}}" class="form-control"><br />
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                            <input class="input" id="address" type="text" name="address" placeholder="Address" value="{{$user->address}}" onchange="copyValue4()">
                        </div> -->
                        </div>
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#province').on('change', function() {
            var province_id = $(this).val();
            if (province_id) {
                $.ajax({
                    url: '/get-districts/' + province_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district').empty();
                        $('#ward').empty();
                        $('#address').empty();
                        $('#district').append('<option value="">Chọn Quận/Huyện</option>');
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

    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    };
    $(document).ready(function() {
    $('#showCaption').on('change', function() {
        if ($(this).is(':checked')) {
            $('.caption').show(); // Hiển thị div khi checkbox được chọn
        } else {
            $('.caption').hide(); // Ẩn div khi checkbox không được chọn
        }
    });
});
</script>
@endpush