@extends('layout.master')

@section('main-content')
<div class="container"><Br />
    <h1 class="my-4 text-center">Theo dõi đơn hàng</h1><br /><Br />
    <!-- Chi tiết đơn hàng -->
    <div class="order-details">
        <h4>Đơn hàng</h4>
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 130px;" class="text-center">#</th>
                    <th style="width: 450px;" class="text-center">Thông tin giao hàng</th>
                    <th style="width: 150px;" class="text-center">Tổng tiền</th>
                    <th style="width: 200px;" class="text-center">Phương thức thanh toán</th>
                    <th style="width: 150px;" class="text-center">Tình trạng thanh toán</th>
                    <th style="width: 150px;" class="text-center">Tình trạng</th>
                    <th style="width: 40px" class="text-center">Xác nhận</th>
                    <th style="width: 40px" class="text-center">Hủy</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $key)
                <tr>
                    <td class="text-center">
                        <a href="/tracking_order/{{$key->id}}">Mã đơn: {{$key->id}}</a>
                    </td>
                    <td class="text-left">
                        <label>Tên : </label> {{$key->name}}<br />
                        <label>Ngày mua : </label> {{$key->order_date}}<br />
                        <label>email : </label> {{$key->email}}<br />
                        <label>SĐT : </label> {{$key->phone}}<br />
                        <label>Địa chỉ giao hàng : </label> {{$key->address}}<br />
                        <label>Lời nhắn : </label> {{$key->messages}}<br />
                    </td>
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
                    <td>
                        @if($key->status == 'process')
                        <form method="POST" action="{{route('user.ordercomfirm',$key->id)}}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm float-left mr-1" style="height:45px; width:110px;border-radius:40%" data-toggle="tooltip" title="confirm" data-placement="bottom">Đã nhận hàng </a>
                        </form>
                        @endif

                    </td>
                    <td>
                        @if($key->status != 'delivered' && $key->status != 'cancel' && $key->status != 'process')
                        <form method="POST" action="{{route('admin.orderscancel',$key->id)}}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$key->id}} style="height:50px; width:50px;border-radius:40%" data-toggle="tooltip" data-placement="bottom" title="Delete">Hủy</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')

<!-- Page level plugins -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</script>
<script>
    console.log('Loading');
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.dltBtn').click(function(e) {
            var form = $(this).closest('form');
            var dataID = $(this).data('id');
             //alert(dataID);
            e.preventDefault();
            swal({
                    title: "Bạn muốn hủy đơn hàng này?",
                    text: "Khi hủy, bạn sẽ không thể khôi phục lại!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Dữ liệu của bạn an toàn!");
                    }
                });
        })
    })
</script>
@endpush