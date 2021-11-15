<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
</head>

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
                            Add Manager
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Manager</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Manager</h5>
                                    <h6 class="card-subtitle text-muted">Create a brand new manager and add him to this web app</h6>
                                </div>
                                <div class="card-body">
                                    <form id="validation-form">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Full Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="name" placeholder="Enter full name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="email" placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" placeholder="Enter phone number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Nationality</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nationality" placeholder="Enter nationality">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">NID Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" placeholder="Enter nid number">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Date of Birth</label>
                                            <div class="col-sm-10">
                                                <div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker-date" placeholder="mm/dd/yyyy">
                                                    <div class="input-group-append" data-target="#datetimepicker-date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <fieldset class="form-group">
                                            <div class="row">
                                                <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Gender</label>
                                                <div class="col-sm-10">
                                                    <div class="custom-controls-stacked">
                                                        <label class="custom-control custom-radio">
                                                            <input name="gender" type="radio" class="custom-control-input" value="male">
                                                            <span class="custom-control-label">Male</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="gender" type="radio" class="custom-control-input" value="female">
                                                            <span class="custom-control-label">Female</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="gender" type="radio" class="custom-control-input" value="other">
                                                            <span class="custom-control-label">Other</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>


                                        <div>

                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Upload Photo</label>
                                            <div class="col-sm-10">
                                                <input type="file" class="validation-file" name="validation-file">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" placeholder="Textarea" rows="3"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-10 ml-sm-auto">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="submit" class="btn btn-light">Reset</button>
                                            </div>
                                        </div>
                                    </form>
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

    <script>
        $(function() {

            // Datetimepicker
            $('#datetimepicker-time').datetimepicker({
                format: 'LT'
            });
            $('#datetimepicker-date').datetimepicker({
                format: 'L'
            });

            // Initialize validation
            $("#validation-form").validate({
                focusInvalid: false,
                rules: {
                    "validation-email": {
                        required: true,
                        email: true
                    },
                    "validation-password": {
                        required: true,
                        minlength: 8,
                        maxlength: 20
                    }
                },
                // Errors
                errorPlacement: function errorPlacement(error, element) {
                    var $parent = $(element).parents(".form-group .col-sm-10");
                    // Do not duplicate errors
                    if ($parent.find(".jquery-validation-error").length) {
                        return;
                    }
                    $parent.append(
                        error.addClass("jquery-validation-error small form-text invalid-feedback")
                    );
                },
                highlight: function(element) {
                    var $el = $(element);
                    var $parent = $el.parents(".form-group");
                    $el.addClass("is-invalid");
                    // Select2 and Tagsinput
                    if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") === "tagsinput") {
                        $el.parent().addClass("is-invalid");
                    }
                },
                unhighlight: function(element) {
                    $(element).parents(".form-group").find(".is-invalid").removeClass("is-invalid");
                }
            });
        });
    </script>

</body>

</html>