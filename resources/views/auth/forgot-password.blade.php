@extends('layout.master')

@section('main-content')
    <div class="container">
        <br />
        <h1 class="text-center">Đổi mật khẩu</h1>
        <div class="row vertical-offset">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Xác thực email</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" method="post" action="{{ route('password.email') }}">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input class="form-control" placeholder="Email" name="email" type="email" required
                                        value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="error-message">* {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Xác thực email"><br />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
