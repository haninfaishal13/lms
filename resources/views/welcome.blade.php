@extends('_layout.main_user')
@section('title-user')
<title>Welcome</title>
@endsection
@section('content-user')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Learning Management System</h4>
                <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
            alt="Sample image">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="py-5 pt-5">
                @if (session('auth_error'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                    {!! session('auth_error') !!}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h5>Login</h5>
                    </div>
                    <form action="{{route('auth.login.process')}}" method="post" id="logform">
                        {{ csrf_field() }}
                        <div class="card-body justify-content-center">
                            <div class="form-outline mb-4">
                                <input type="text" name="username" id="username" class="form-control"
                                placeholder="Enter username" />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3">
                                <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter password" />
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Checkbox -->
                                <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                                </div>
                                <a href="#!" class="text-body">Forgot password?</a>
                            </div>

                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('auth.index.register')}}"
                                    class="link-danger">Register</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
