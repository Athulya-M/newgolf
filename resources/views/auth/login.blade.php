@extends('admin.authentication.master')

@section('title')login
 
@endsection

@push('css')
@endpush

@section('content')
    <section>
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="login-card">
                    <form  class="theme-form login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h4>Login</h4>
                        <h6>Welcome back! Log in to your account.</h6>
                        <div class="form-group">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-email"></i></span>
                                <input class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" type="email" required="" name="email" placeholder="Test@gmail.com" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="show-hide"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                                <input class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" type="password"  name="password" required="" placeholder="*********" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="show-hide"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <input id="checkbox1" type="checkbox" name="remember" />
                                <label for="checkbox1">Remember password</label>
                            </div>
                            <a class="link" href="{{route('password.request')}}">Forgot password?</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                        </div>
                        
                        <p>Don't have account?<a class="ms-2" href="#">Create Account</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

    
    @push('scripts')
    @endpush

@endsection