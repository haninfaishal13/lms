@extends('_layout.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">
                <h5>Register</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="#">
                    <div class="form-outline mb-3">
                        <input type="text" id="username" name="uername" class="form-control"
                        placeholder="Username" />
                    </div>

                    <div class="form-outline mb-3">
                        <input type="email" id="email" name="email" class="form-control"
                        placeholder="Email" />
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-3">
                        <input type="password" id="password" name="password" class="form-control"
                        placeholder="Password" />
                    </div>

                    <div class="form-outline mb-3">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                        placeholder="Confirm Password" />
                    </div>

                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-primary btn-lg"
                        style="padding-left: 2.5rem; padding-right: 2.5rem;" id="register">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts-user')
<script>
    $('#register').on('click', function() {
        if($('#password').val() != $('#confirm_password').val()) {
            console.log('password tidak cocok');
        }
    });
</script>
@endsection