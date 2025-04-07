<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- /theme JS files -->    
  </head>
<body>
   <!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form action="{{ route('masuk') }}" method="POST" class="login-form">
                    @csrf
					<div class="card mb-0">
                        
						<div class="card-body">
							<div class="text-center mb-3">
								<h5 class="mb-0">Login</h5>
								<span class="d-block text-muted">Enter your credentials below</span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input type="checkbox" id="remember-me" class="form-input-styled">
										Remember
									</label>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="form-group text-center text-muted content-divider">
								<span class="px-2">Don't have an account?</span>
							</div>

							<div class="form-group">
								<a href="{{ route('register') }}" class="btn btn-light btn-block">Sign up</a>
							</div>

						</div>
					</div>
				</form>
				<!-- /login card -->

			</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    @endif

    @if ($errors->any())
        let errorList = '';
        @foreach ($errors->all() as $error)
            errorList += '{{ $error }}\n';
        @endforeach

        Swal.fire({
            icon: 'error',
            title: 'Login Gagal!',
            text: errorList,
        });
    @endif
</script>

</html>
