@extends('layout.master')

@section('main-content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Home</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form method="post" action="{{route('user.payment_cash')}}">
                {{csrf_field()}}
                <div class="col-md-7">
                    <!-- Billing Details -->

                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Thông tin giao hàng</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" id="name" type="text" name="name" placeholder="Enter your name" value="{{$user->name}}" onchange="copyValue()">
                        </div>
                        <div class="form-group">
                            <input class="input" id="email" type="email" name="email" placeholder="Email" value="{{$user->email}}" onchange="copyValue2()">
                        </div>
                        <div class="form-group">
                            <input class="input" id="phone" type="tel" name="phone" placeholder="Phone" value="{{$user->phone}}" onchange="copyValue3()">
                        </div>
                    </div>
                    <!-- /Billing Details -->

                    <!-- Shiping Details -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Shiping address</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address">
                            <label for="shiping-address">
                                <span></span>
                                Ship to a diffrent address?
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
                                    <input id="street" type="text" name="street" value="{{old('street')}}" id="street" class="form-control"><br />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="input" id="address" type="text" name="address" placeholder="Address" value="{{$user->address}}" onchange="copyValue4()">
                        </div>
                    </div>
                    <!-- /Shiping Details -->

                    <!-- Order notes -->
                    <div class="order-notes">
                        
                        <textarea class="input" id="messages" placeholder="Order Notes" name="messages" onchange="copyValue5()"></textarea>
                    </div>
                    <!-- /Order notes -->
                </div>

                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Đơn hàng của bạn</h3>
                    </div>
                    <div class="order-summary">

                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>TOTAL</strong></div>
                        </div>

                        <div class="order-products">
                            @foreach($cart as $key)
                            <div class="order-col">
                                <div>{{$key->quantity}}x {{$key->products->name}}</div>
                                <div>{{number_format($key->amount,0)}} VNĐ</div>
                            </div>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Shiping</div>
                            <div><strong>FREE</strong></div>
                        </div>

                        <div class="order-col">
                            <div><strong>TỔNG TIỀN</strong></div>
                            <div><strong class="order-total">{{number_format($tongtien,0)}} VNĐ</strong></div>
                        </div>
                    </div>
                    <button class="primary-btn order-submit" style="width: 100%;">Thanh toán tiền mặt</button>
            </form>
            <form action="{{route('user.paymentmomo')}}" method="post">
            {{csrf_field()}}
                <input type="text" style="display: none;" id="name2" name="name2" value="{{$user->name}}">
                <input type="text" style="display: none;" id="phone2" name="phone2" value="{{$user->phone}}">
                <input type="text" style="display: none;" id="email2" name="email2" value="{{$user->email}}">
                <input type="text" style="display: none;" id="address2" name="address2" value="{{$user->address}}">
                <input type="text" style="display: none;" id="messages2" name="messages2" value="">
                <input type="text" style="display: none;" id="amount" name="amount" value="{{$tongtien}}">
                <button name="payUrl" type="submit" class="primary-btn order-submit" style="width: 100%;">Thanh toán MOMO</button>
            </form>
        </div>
        <!-- /Order Details -->
    </div>
    <!-- /row -->


</div>
<!-- /container -->
</div>
<!-- /SECTION -->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
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
                        $('#address').empty();
                        $('#address2').empty();
                        $('#district').append('<option value="">Chọn Quận/Huyện</option>');
                        $('#address').val(data.province_name); // Hiển thị province_name
                        $('#address2').val(data.province_name); // Hiển thị province_name
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
                        $('#address2').val(data.district_name + ", " + $('#address').val());
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
                        $('#address2').val(data.ward_name + ", " + $('#address').val());
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
        $('#address2').val(newValue + ", " + $('#address').val());
    });

    function copyValue() {
            var value = document.getElementById("name").value;
            document.getElementById("name2").value = value;
        }
        function copyValue2()
        {
            var value = document.getElementById("email").value;
            document.getElementById("email2").value = value;
        }
        function copyValue3()
        {
            var value = document.getElementById("phone").value;
            document.getElementById("phone2").value = value;
        }
        function copyValue4()
        {
            var value = document.getElementById("address").value;
            document.getElementById("address2").value = value;
        }
        function copyValue5()
        {
            var value = document.getElementById("messages").value;
            document.getElementById("messages2").value = value;
        }
</script>
@endpush