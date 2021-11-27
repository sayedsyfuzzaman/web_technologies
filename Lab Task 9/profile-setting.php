<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Settings</title>
	<link href="css/modern.css" rel="stylesheet">
	<script src="js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		document.getElementById('home').className = "sidebar-item";
		document.getElementById('view_profile').className = "sidebar-item active";
	</script>
	<script src="js/jQuarrayValidation.js"></script>

	<link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
	<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
	<script>
		$(document).ready(function() {
			$("#picture-error").hide();

			var $modal = $('#modal_crop');
			var crop_image = document.getElementById('sample_image');
			var cropper;
			$('#upload_image').change(function(event) {
				var files = event.target.files;
				var ext = $("#upload_image").val().split('.').pop();
				
				if (ext.match(/jpg/) || ext.match(/png/) || ext.match(/jpeg/) || ext.match(/JPG/) ) {
					$("#picture-error").hide();
					var done = function(url) {
						crop_image.src = url;
						$modal.modal('show');
					};

					if (files && files.length > 0) {
						reader = new FileReader();
						reader.onload = function(event) {
							done(reader.result);
						};
						reader.readAsDataURL(files[0]);
					}
				} else {
					$("#picture-error").html("This field can contain only jpg, png and jpeg file.");
					$("#picture-error").show();
				}

			});
			$modal.on('shown.bs.modal', function() {
				cropper = new Cropper(crop_image, {
					aspectRatio: 1,
					viewMode: 3,
					preview: '.preview'
				});
			}).on('hidden.bs.modal', function() {
				cropper.destroy();
				cropper = null;
			});
			$('#crop_and_upload').click(function() {
				canvas = cropper.getCroppedCanvas({
					width: 400,
					height: 400
				});
				canvas.toBlob(function(blob) {
					url = URL.createObjectURL(blob);
					var reader = new FileReader();
					reader.readAsDataURL(blob);
					reader.onloadend = function() {
						var base64data = reader.result;
						$.ajax({
							url: 'controller/image_upload.php',
							method: 'POST',
							data: {
								crop_image: base64data
							},
							success: function(data) {
								$modal.modal('hide');
								$(document).ajaxStop(function() {
									window.location.reload();
								});
							}
						});
					};
				});
			});
		});
	</script>
	<style>
		img {
			max-width: 100%;
		}

		.preview {
			overflow: hidden;
			width: 160px;
			height: 160px;
			margin: 10px;
			border: 1px solid red;
		}
	</style>
</head>
<?php
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	header("location:sign-in.php");
}
?>

<body>
	<div class="wrapper">
		<?php
		include 'sidebar.php';
		?>
		<div class="main">
			<?php
			include 'navbar.php';
			?>

			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
							Settings
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
								<li class="breadcrumb-item active" aria-current="page">Settings</li>
							</ol>
						</nav>
					</div>

					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
										Account
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
										Password
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">
											<h1 class="card-title mb-8 text-success">
												<?php
												if (isset($message)) {
													echo $message;
												}
												?>
											</h1>
											<h5 class="card-title mb-0">Information</h5>
										</div>
										<div class="card-body">
											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="inputUsername">ID:</label>
														<input type="text" class="form-control text-dark" id="id" name="id" disabled value="<?php echo $_SESSION["id"]; ?>">
													</div>
													<div class="form-group">
														<label for="inputUsername">Designation:</label>
														<input type="text" class="form-control text-dark" id="name" disabled value="<?php echo $_SESSION["usertype"]; ?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="text-center">
														<img id="picture" name="picture" id="picture" src="<?php echo $_SESSION["image"]; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
														<div class="mt-2">
															<label class="form-label" for="customFile">Change Image</label>

															<form method="post">
																<input type="file" name="crop_image" class="crop_image form-control" id="upload_image" />
															</form>
															<label id="picture-error" class="error validation-error small form-text invalid-feedback"></label>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="modal fade" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Crop Image Before Upload</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="img-container">
														<div class="row">
															<div class="col-md-8">
																<img src="" id="sample_image" />
															</div>
															<div class="col-md-4">
																<div class="preview"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" id="crop_and_upload" class="btn btn-primary">Upload</button>
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Change Information</h5>
										</div>
										<div class="card-body">

											<form id="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Full Name<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION["name"]; ?>">
														<label id="name-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Email<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"]; ?>">
														<label id="email-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id=phone name="phone" value="<?php echo $_SESSION["phone"]; ?>">
														<label id="phone-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Nationality<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $_SESSION["nationality"]; ?>">
														<label id="nationality-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">NID Number<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="nid" name="nid" value="<?php echo $_SESSION["nid"]; ?>">
														<label id="nid-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Date of Birth</label>
													<div class="col-sm-10">
														<div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
															<input type="date" class="form-control" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" onchange="validate_dob()" value="<?php echo $_SESSION["dob"]; ?>">
															<label id="dob-error" class="error validation-error small form-text invalid-feedback"></label>
														</div>
													</div>
												</div>

												<fieldset class="form-group">
													<div class="row">
														<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Gender</label>
														<div class="col-sm-10">
															<div class="custom-controls-stacked">
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="male" <?php if ($_SESSION["gender"] == "male") echo "checked"; ?>>
																	<span class="custom-control-label">Male</span>
																</label>
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="female" <?php if ($_SESSION["gender"] == "female") echo "checked"; ?>>
																	<span class="custom-control-label">Female</span>
																</label>
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="other" <?php if ($_SESSION["gender"] == "other") echo "checked"; ?>>
																	<span class="custom-control-label">Other</span>
																</label>
															</div>
														</div>
													</div>
												</fieldset>

												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Address</label>
													<div class="col-sm-10">
														<textarea name="address" class="form-control" placeholder="Enter your address" rows="3"><?php echo $_SESSION["address"]; ?></textarea>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-10 ml-sm-auto">
														<button id="insert" type="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>
											</form>
										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form>
												<div class="form-group">
													<label for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control" id="inputPasswordCurrent">
													<small><a href="#">Forgot your password?</a></small>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew">New password</label>
													<input type="password" class="form-control" id="inputPasswordNew">
												</div>
												<div class="form-group">
													<label for="inputPasswordNew2">Verify password</label>
													<input type="password" class="form-control" id="inputPasswordNew2">
												</div>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</form>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php
			include 'footer.php';
			?>

		</div>

	</div>

	<!-- Javascript Start from here -->
	<script src="js/app.js"></script>

</body>

</html>