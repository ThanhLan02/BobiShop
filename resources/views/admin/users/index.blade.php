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
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">User Tables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">   
        <a href="/userscreate" class="btn btn-dark btn-lg" role="button">Add User</a>
        <br /><br />
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(count($users)>0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 300px">Information</th>
                                    <th style="width: 100px">Image</th>
                                    <th style="width: 100px">Description</th>
                                    <th style="width: 100px">Role</th>
                                    <th style="width: 20px">Status</th>
                                    <th style="width: 20px">Action</th>
                                </tr>
                            </thead>
                            @foreach($users as $user)
                            <tbody>

                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>
                                        <label for="name">Name : </label> {{$user->name}}<br />
                                        <label for="phone">Phone : </label> {{$user->phone}}<br />
                                        <label for="address">Address : </label> {{$user->address}}<br />
                                        <label for="birthday">Birthday : </label> {{$user->birthday}}<br />
                                        <label for="gender">Gender : </label> {{$user->gender}}<br />
                                        <label for="email">Email : </label> {{$user->email}}<br />
                                    </td>
                                    <td>
                                        <img src="{{$user->image}}" width="200px" height="200px" alt="">
                                    </td>
                                    <td>
                                        {{$user->description}}
                                    </td>
                                    <td>
                                        @if ($user->role === 'admin')
                                        <p style="color:red">{{$user->role}}</p>
                                        @else
                                        <p style="color:blue">{{$user->role}}</p>
                                        @endif
                                    </td>
                                    <td>

                                        <div class="form-group">

                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" id="modelId{{ $user->id }}" value="{{ $user->id }}">
                                                <input type="checkbox" class="custom-control-input status" id="customSwitch{{ $user->id }}" name="status" value="{{ $user->status }}" {{ $user->status == 'active' ? 'checked' : '' }}>
                                                @if($user->status == 'active')
                                                <label class="custom-control-label" for="customSwitch{{ $user->id }}">Active</label>
                                                @else
                                                <label class="custom-control-label" for="customSwitch{{ $user->id }}">Inactive</label>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.usersupdate',$user->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:45px; width:50px;border-radius:40%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{route('admin.usersdelete',$user->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm dltBtn" data-id={{$user->id}} style="height:50px; width:50px;border-radius:40%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
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
                            {{$users->links('pagination::bootstrap-4')}}
                        </div>

                    </div>
                    @else
                    <h6 class="text-center">No user found!!! Please create user</h6>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    $(document).ready(function() {
        $('.status').change(function() {
            var status = $(this).is(':checked') ? 'active' : 'inactive';
            var token = $('input[name="_token"]').val();
            var id = $(this).closest('.custom-control').find('input[type="hidden"][id^="modelId"]').val();
            console.log('Status:', status, 'ID:', id, 'Token:', token);

            $.ajax({
                url: '/update-status-users/' + id,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: {
                    '_token': token,
                    'id': id,
                    'status': status
                },
                success: function(response) {
                    console.log(response);
                    Swal.fire({
                        icon: "success",
                        title: "Update Status User successfully",
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Something went wrong!",
                    });
                }
            });
        });
    });
</script>
@endpush