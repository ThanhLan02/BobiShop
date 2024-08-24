@extends('layout.master')

@section('main-content')
    <div class="container">
        <br />
        <h1 class="text-center">Đăng Nhập</h1>
        <div class="row vertical-offset">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin đăng nhập</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.dologin') }}">
                            @csrf
                            <fieldset>
                                <!-- @if ($errors->any())
    <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
                                    </ul>
                                </div>
    @endif -->
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input class="form-control" placeholder="Email" name="email" type="text"
                                        value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="error-message">* {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Mật khẩu</label>
                                    <input class="form-control" placeholder="password" name="password" type="password">
                                    @if ($errors->has('password'))
                                        <span class="error-message">* {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login"><br />
                                <h5 class="text-center"><a href="{{ route('password.request') }}" class="text-left">Quên mật
                                        khẩu</a> - <a href="/Dangky" class="text-right">Đăng ký</a></h5>


                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
