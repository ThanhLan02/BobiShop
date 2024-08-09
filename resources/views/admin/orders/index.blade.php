@extends('admin.layout.master')

@section('main-content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tracking Orders</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Orders Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <br /><br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Orders Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(count($orders)>0)
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th style="width: 10px">#</th>
                                    <th>Information</th>
                                    <th>shipping address</th>
                                    <th style="width: 200px">Messages</th>
                                    <th>Amount</th>
                                    <th>Payment method</th>
                                    <th>Payment status</th>
                                    <th>Status</th>
                                    <th style="width: 40px">Confirm</th>
                                    <th style="width: 40px">Cancel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key)
                                <tr>
                                    <td class="text-center"><a href="#" class="order-link" data-id="{{$key->id}}">Đơn hàng {{$key->id}}</a></td>
                                    <td>
                                        <label style="font-weight: bold;">Name : </label> {{$key->name}}<br />
                                        <label style="font-weight: bold;">Order date : </label> {{$key->order_date}}<br />
                                        <label style="font-weight: bold;">Email : </label> {{$key->email}}<br />
                                        <label style="font-weight: bold;">Phone : </label> {{$key->phone}}<br />
                                    </td>
                                    <td class="text-center">{{$key->address}}</td>
                                    <td class="text-center">{{$key->messages}}</td>
                                    <td class="text-center">{{number_format($key->amount,0)}} VNĐ</td>
                                    <td class="text-center">{{$key->payment_method}}</td>
                                    <td class="text-center">{{$key->payment_status}}</td>
                                    <td class="text-center">{{$key->status}}</td>
                                    <td>
                                        @if($key->status == 'new')
                                        <form method="POST" action="{{route('admin.ordersdoupdate',$key->id)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm float-left mr-1" style="height:45px; width:50px;border-radius:40%" data-toggle="tooltip" title="confirm" data-placement="bottom"><i class="fas fa-check"></i> </a>
                                        </form>
                                        @endif

                                    </td>
                                    <td>
                                        @if($key->status != 'delivered' && $key->status != 'cancel')
                                        <form method="POST" action="{{route('admin.orderscancel',$key->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$key->id}} style="height:50px; width:50px;border-radius:40%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-times"></i></button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table><br/>
                        <h2 style="display:none;" id="title">Chi tiết đơn hàng </h2>
                        <div id="order-details" style="display:none;">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr >
                                        <th style="width: 700px;">Product</th>
                                        <th>Product image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="order-details-body">
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{$orders->links('pagination::bootstrap-4')}}
                        </div>

                    </div>
                    @else
                    <h6 class="text-center" >No brands found!!! Please create brand</h6>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')

<!-- Page level plugins -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

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

    document.addEventListener('DOMContentLoaded', function() {
        var orderLinks = document.querySelectorAll('.order-link');

        orderLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
                var orderId = this.getAttribute('data-id');

                // Gọi AJAX để lấy chi tiết đơn hàng
                fetch('/get-order-details/' + orderId)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Hiển thị chi tiết đơn hàng
                        var detailsBody = $('#order-details-body');
                        detailsBody.empty();
                        data.forEach(function(detail) {
                            var row = '<tr>' +
                                '<td>' + detail.products.name + '</td>' +
                                '<td class="text-center"> <img src="' + detail.products.image + '" width="200px" height="200px" alt=""></td>' +
                                '<td class="text-center">' + detail.quantity + '</td>' +
                                '<td class="text-center">' + detail.price + ' VNĐ</td>' +
                                '<td class="text-center">' + detail.amount + ' VNĐ</td>' +
                                '</tr>';
                            detailsBody.append(row);
                        });title
                        $('#order-details').show();
                        $('#title').show();
                    //     console.log(data.product_id);
                    //     var detailsDiv = document.getElementById('order-details');
                    //     detailsDiv.innerHTML = `
                    //     <h3>Chi tiết đơn hàng ` + data.product_id + ` </h3>
                    //     <p>Sản phẩm: ${data.product_id}</p>
                    //     <p>Số lượng: ${data.quantity}</p>
                    //     <p>Giá: ${data.price}</p>
                    //     <p>tổng tiền: ${data.amount}</p>
                    // `;
                    //     detailsDiv.style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        var detailsDiv = document.getElementById('order-details');
                        detailsDiv.innerHTML = '<p>Đã xảy ra lỗi khi tải chi tiết đơn hàng.</p>';
                        detailsDiv.style.display = 'block';
                    });
            });
        });
    });
</script>
@endpush