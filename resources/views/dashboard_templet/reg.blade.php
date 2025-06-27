<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard_templet.header')
    <title>{{ isset($page_title) && $page_title ? $page_title : 'iarifbd' }} - UCMAS360°</title>
    @include('dashboard_templet.custom_css_dashboard')
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Get started</h1>
							<p class="lead">
								Start creating the best possible user experience for you customers.
							</p>
						</div>
						<form method="POST" action="{{ route('admin_reg') }}">
							@csrf
							<div class="card">
								<div class="card-body">
									<div class="m-sm-3">
										<form>
											<div class="mb-3">
												<label class="form-label">Full name</label>
												<input class="form-control form-control-lg" type="text" id="name" name="name" placeholder="Enter your name" />
											</div>
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input class="form-control form-control-lg" type="email" id="email" name="email" placeholder="Enter your email" />
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter password" />
											</div>
											<div class="mb-3">
												<label class="form-label">Confirm Password</label>
												<input class="form-control form-control-lg" type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter password" />
											</div>
											<div class="d-grid gap-2 mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Sign up</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</form>
						<div class="text-center mb-3">
							Already have account? <a href="{{ route('admin_login') }}">Log In</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

</body>

</html>