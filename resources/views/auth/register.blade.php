<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assetslog/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script src="{{ asset('assetslog/global_assets/js/main/jquery.min.js') }}"></script>
    <script src="{{ asset('assetslog/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetslog/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="{{ asset('assetslog/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('assetslog/assets/js/app.js') }}"></script>
    <script src="{{ asset('assetslog/global_assets/js/demo_pages/login.js') }}"></script>
    <!-- /theme JS files -->    
  </head>
<body>
   <!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Register card -->
				<form action="{{ route('daftar') }}" method="POST" class="login-form">
                    @csrf
					<div class="card mb-0">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
						<div class="card-body">
							<div class="text-center mb-3">
								<h5 class="mb-0">Create Account</h5>
								<span class="d-block text-muted">Fill in your details below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
								<div class="form-control-feedback">
									<i class="icon-envelop5 text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

                            <!-- Role selection -->
							<div class="form-group form-group-feedback form-group-feedback-left">
								<select name="role" id="role" class="form-control" required>
									<option value="" disabled selected>Select Role</option>
									<option value="admin">Admin</option>
									<option value="salesman">Salesman</option>
								</select>
								<div class="form-control-feedback">
									<i class="icon-users text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Register <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<span class="px-2">Already have an account?</span>
							</div>

							<div class="form-group">
								<a href="{{ route('login') }}" class="btn btn-light btn-block">Login</a>
							</div>

						</div>
					</div>
				</form>
				<!-- /Register card -->

			</div>
			<!-- /Content area -->

		</div>
		<!-- /Main content -->

	</div>
	<!-- /Page content -->
</body>
</html>
