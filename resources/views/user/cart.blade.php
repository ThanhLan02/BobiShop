@extends('layout.master')

@section('main-content')
    <div class="container">
        <br />
        <h2 class="fw-bolder text-center">Giỏ hàng</h2>
        <center>
            <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
        </center>

        <div class="card rounded-0 shadow">
            <div class="card-body">
                <div class="container-fluid">

                    <table class="table">
                        <tr>
                            <th style="width: 300px;" class="text-center">Tên</th>
                            <th class="text-center">Ảnh</th>
                            <th class="text-center">Số Lượng</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Thao Tác</th>
                        </tr>
                        @foreach ($cart as $key)
                            <tr>
                                <td class="text-center"><a href="">{{ $key->products->name }}</a></td>
                                <td class="text-center"><img src="{{ $key->products->image }}" alt=""
                                        style="width: 200px;height: 200px;"></td>
                                <td class="text-center">
                                    <form action="{{ route('user.updatequantitycart', $key->id) }}" method="post">
                                        @csrf
                                        <input type="number" name="quantity" style="width: 40px;"
                                            value="{{ $key->quantity }}">
                                        <button type="submit" name="send" style="border-radius: 50%;" value="send"
                                            class="btn btn-primary align-center"><i class="fa fa-pencil"></i></button>
                                    </form>
                                </td>
                                <td class="text-center">{{ number_format($key->price, 0) }} VNĐ</td>
                                <td class="text-center">{{ number_format($key->amount, 0) }} VNĐ</td>
                                <td class="text-center">
                                    <form action="{{ route('user.deletesinglecart', $key->id) }}" method="post">
                                        @csrf
                                        <button type="submit" name="send" value="send"
                                            class="btn btn-primary align-center" style="border-radius: 50%;">Xóa</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        <tr>

                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th></th>
                            <th></th>
                            <th>{{ number_format($tongtien, 0) }} VNĐ</th>
                            <th>&nbsp;</th>
                        </tr>
                    </table>

                </div>
            </div>
            <div class="card-footer text-center ">
                <form action="{{ route('user.deleteallcart') }}" method="post">
                    @csrf
                    <button type="submit" name="send" value="send" class="btn btn-success rounded-0">Xóa hết</button>
                    <a href="/checkout" class="btn btn-danger rounded-0">XÁC NHẬN MUA</a>
                    <a href="/" class="btn btn-warning rounded-0">Tiếp tục mua</a>
                    <a href="{{ route('user.order_list') }}" class="btn btn-info rounded-0">Xem các đơn hàng đã mua</a>
                </form>

            </div>
        </div>
    </div>
    <br />
    <br />
@endsection
