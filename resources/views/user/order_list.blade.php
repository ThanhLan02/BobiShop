@extends('layout.master')

@section('main-content')
<div class="container"><Br/>
    <h1 class="my-4 text-center">Theo dõi đơn hàng</h1><br/><Br/>
    <!-- Chi tiết đơn hàng -->
    <div class="order-details">
        <h4>Đơn hàng</h4>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 130px;" class="text-center">#</th>
                    <th style="width: 450px;" class="text-center">Thông tin giao hàng</th>
                    <th style="width: 300px;" class="text-center">Lời nhắn</th>
                    <th style="width: 150px;" class="text-center">Tổng tiền</th>
                    <th style="width: 200px;" class="text-center">Phương thức thanh toán</th>
                    <th style="width: 150px;" class="text-center">Tình trạng thanh toán</th>
                    <th style="width: 150px;" class="text-center">Tình trạng</th>
                    <th style="width: 100px;" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $key)
                <tr>
                    <td class="text-center">
                        <a href="/tracking_order/{{$key->id}}">Mã đơn: {{$key->id}}</a>
                    </td>
                    <td class="text-left">
                        <label>Tên : </label> {{$key->name}}<br/>
                        <label>Ngày mua : </label> {{$key->order_date}}<br/>
                        <label>email : </label> {{$key->email}}<br/>
                        <label>SĐT : </label> {{$key->phone}}<br/>
                        <label>Địa chỉ giao hàng : </label> {{$key->address}}<br/>
                    </td>
                    <td>{{$key->messages}}</td>
                    <td class="text-center">{{number_format($key->amount,0)}} VNĐ</td>
                    @if($key->payment_method == 'cash')
                        <td class="text-center">Tiền mặt</td>   
                    @else
                        <td class="text-center">Thanh toán online</td>  
                    @endif
                    @if($key->payment_status == 'pending')
                        <td class="text-center">Chưa thanh toán</td>   
                    @else
                        <td class="text-center">Đã thanh toán</td>  
                    @endif
                    @if($key->status == 'new')
                        <td class="text-center">Chờ xác nhận</td>   
                    @elseif($key->status == 'process')
                        <td class="text-center">Đã xác nhận - Đang giao</td>  
                    @elseif($key->status == 'delivered')
                        <td class="text-center">Đã giao</td>
                    @else
                        <td class="text-center">Đã hủy</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection