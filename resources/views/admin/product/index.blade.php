@extends('admin.layout.master')

@section('main-content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Product Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <a href="/productcreate" class="btn btn-dark btn-lg" role="button">Add Product</a>
        <br /><br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Product Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(count($products)>0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 300px">Information</th>
                                    <th style="width: 100px">Image</th>
                                    <th style="width: 100px">Description</th>
                                    <th style="width: 100px">Condition</th>
                                    <th style="width: 20px">Status</th>
                                    <th style="width: 20px">Action</th>
                                </tr>
                            </thead>
                            @foreach($products as $product)
                            <tbody>

                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>
                                        <label for="name">Name : </label> {{$product->name}}<br />
                                        <label for="brand">Brand : </label> {{$product->brand->name}}<br />
                                        <label for="category">Category : </label> {{$product->category->name}}<br />
                                        <label for="quantity">Quantity : </label> {{$product->quantity}}<br />
                                        <label for="discount">Discount : </label> {{$product->discount}}<br />
                                        <label for="old_price">Old price : </label> {{$product->old_price}}<br />
                                        <label for="new_price">New price : </label> {{$product->new_price}}<br />
                                    </td>
                                    <td>
                                        <img src="{{$product->image}}" width="200px" height="200px" alt="">
                                    </td>
                                    <td>
                                    {{$product->description}}
                                    </td>
                                    @if($product->condition == 'new')
                                    <td><span class="badge bg-success">{{$product->condition}}</span></td>
                                    @elseif($product->condition == 'default')
                                    <td><span class="badge bg-default">{{$product->condition}}</span></td>
                                    @else
                                    <td><span class="badge bg-danger">{{$product->condition}}</span></td>
                                    @endif
                                    <td>

                                        <div class="form-group">
                                            <div class="custom-control custom-switch">

                                                @if($product->status == 'active')
                                                <input type="checkbox" class="custom-control-input" id="customSwitch{{$product->id}}" checked>
                                                <label class="custom-control-label" for="customSwitch{{$product->id}}">Active</label>
                                                @else
                                                <input type="checkbox" class="custom-control-input" id="customSwitch{{$product->id}}">
                                                <label class="custom-control-label" for="customSwitch{{$product->id}}">InActive</label>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.productupdate',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:45px; width:50px;border-radius:40%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{route('admin.productdelete',$product->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:50px; width:50px;border-radius:40%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>

                            </tbody>
                            @endforeach
                        </table>
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <div class="float-right">
                            {{$products->links('pagination::bootstrap-4')}}
                        </div>

                    </div>
                    @else
                    <h6 class="text-center">No product found!!! Please create product</h6>
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
                    title: "Bạn muốn xóa?",
                    text: "Khi xóa, bạn sẽ không thể khôi phục lại!",
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