@extends('layout.master')

@section('main-content')
    <div class="container">
        <br />
        <h1 class="text-center">Đổi mật khẩu</h1>
        <div class="row vertical-offset">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Đổi mật khẩu</h3>
                    </div>
                    <div class="panel-body">
                        <form accept-charset="UTF-8" role="form" method="post" action="{{ route('password.update') }}">
                            @csrf
                            <fieldset>
                                <input type="hidden" name="token" value="{{ $token->token }}">
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input class="form-control" placeholder="Email" name="email" type="email" required
                                        value="{{ $email_reset }}" readonly>
                                    @if ($errors->has('email'))
                                        <span class="error-message">* {{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Mật khẩu mới"
                                        required>
                                    @if ($errors->has('password'))
                                        <span class="error-message">* {{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="username">Nhập lại password</label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        placeholder="Mật khẩu mới" required>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="error-message">* {{ $errors->first('password_confirmation') }}</span>
                                    @endif
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Đổi mật khẩu"><br />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
