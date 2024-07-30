@extends('layout.master')

@section('main-content')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card"><br/>
                    <div class="card-header">
                        <h3 class="card-title text-center">Chi tiết đơn hàng : #{{$id}}</h3>
                    </div><br/>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(count($order_details)>0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 500px" class="text-center">Sản phẩm</th>
                                    <th style="width: 300px" class="text-center">Ảnh sản phẩm</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order_details as $key)
                                <tr>
                                    <td class="text-center">{{$key->products->name}}</td>
                                    <td class="text-center"><img src="{{$key->products->image}}" alt="" style="width: 200px;height: 200px;"></td>
                                    <td class="text-center">{{$key->quantity}}</td>
                                    <td class="text-center">{{number_format($key->price,0)}} VNĐ</td>
                                    <td class="text-center">{{number_format($key->amount,0)}} VNĐ</td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    @else
                    <h6 class="text-center">Không có đơn nào cả</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection