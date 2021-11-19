<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>

    <script type="text/javascript">
        function validate_name() {
            let name = document.forms["regForm"]["name"].value;
            let error;
            if (name == "") {
                error = "This field is required.";
                document.getElementById("name-error").innerHTML = error;
                document.getElementById('name').className = "form-control is-invalid";
                return false;
            } else if (/[A-Za-z]/.test(name[0]) == false) {
                error = "Must start with a letter.";
                document.getElementById("name-error").innerHTML = error;
                document.getElementById('name').className = "form-control is-invalid";
                return false;
            } else if (/^[A-Za-z\s._-]+$/.test(name) == false) {
                error = "Name can contain letter,desh,dot and space.";
                document.getElementById("name-error").innerHTML = error;
                document.getElementById('name').className = "form-control is-invalid";
                return false;
            } else if (name.match(/(\w+)/g).length < 2) {
                error = "Cannot contain less than two word.";
                document.getElementById("name-error").innerHTML = error;
                document.getElementById('name').className = "form-control is-invalid";
                return false;
            } else {
                error = "";
                document.getElementById("name-error").innerHTML = error;
                document.getElementById('name').className = "form-control";
                return true;
            }
        }

        function validate_email() {
            let email = document.forms["regForm"]["email"].value;
            let error;
            if (email == "") {
                error = "This field is required.";
                document.getElementById("email-error").innerHTML = error;
                document.getElementById('email').className = "form-control is-invalid";
                return false;
            } else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email) == false) {
                error = "Invalid email format.";
                document.getElementById("email-error").innerHTML = error;
                document.getElementById('email').className = "form-control is-invalid";
                return false;
            } else {
                error = "";
                document.getElementById("email-error").innerHTML = error;
                document.getElementById('email').className = "form-control";
                return true;
            }
        }


        function validate_phone() {
            let phone = document.getElementById("phone").value;
            let error;

            if (isNaN(phone)) {
                error = "Invalid phone number.";
                document.getElementById("phone-error").innerHTML = error;
                document.getElementById('phone').className = "form-control is-invalid";
                return false;
            } else if (phone.length != 11) {
                error = "Phone number must be equal to 11.";
                document.getElementById("phone-error").innerHTML = error;
                document.getElementById('phone').className = "form-control is-invalid";
                return false;
            } else {
                error = "";
                document.getElementById("phone-error").innerHTML = error;
                document.getElementById('phone').className = "form-control";
                return true;
            }
        }


        function validate_nationality() {
            let nationality = document.getElementById("nationality").value;
            let error;

            if (nationality == "") {
                error = "This field is required.";
                document.getElementById("nationality-error").innerHTML = error;
                document.getElementById('nationality').className = "form-control is-invalid";
                return false;
            }
            if (/^[a-zA-Z]+$/.test(nationality) == false) {

                error = "Cannot contain integers or characters.";
                document.getElementById("nationality-error").innerHTML = error;
                document.getElementById('nationality').className = "form-control is-invalid";
                return false;
            } else {
                error = "";
                document.getElementById("nationality-error").innerHTML = error;
                document.getElementById('nationality').className = "form-control";
                return true;
            }
        }

        function validate_nid() {
            let nid = document.getElementById("nid").value;
            let error;

            if (nid == "") {
                error = "This field is required.";
                document.getElementById("nid-error").innerHTML = error;
                document.getElementById('nid').className = "form-control is-invalid";
                return false;
            }
            if (/^[0-9]*$/.test(nid) == false) {

                error = "Cannot contain alphabet or characters.";
                document.getElementById("nid-error").innerHTML = error;
                document.getElementById('nid').className = "form-control is-invalid";
                return false;
            } else {
                error = "";
                document.getElementById("nid-error").innerHTML = error;
                document.getElementById('nid').className = "form-control";
                return true;
            }
        }


        function validate_form() {
            let correctName = validate_name();
            let correctEmail = validate_email();
            let correctNationality = validate_nationality();
            let correctNid = validate_nid();
            let Phone = document.getElementById("phone").value;
            if(Phone != "") {
                correctPhone == validate_phone();
            }
            else {
                correctPhone = ""
            }
            if (correctName && correctPhone && correctEmail && correctNationality && correctNid) {
                return true;
            } else {
                return false;
            }
        }
    </script>
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
                                    <form name="regForm" onsubmit="return validate_form()" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Full Name<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" onblur="validate_name()" onkeyup="validate_name()">
                                                <label id="name-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Email<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" onblur="validate_email()" onkeyup="validate_email()">
                                                <label id="email-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id=phone name="phone" placeholder="Enter phone number" onkeyup="validate_phone()">
                                                <label id="phone-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Nationality<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter nationality" onblur="validate_nationality()" onkeyup="validate_nationality()">
                                                <label id="nationality-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">NID Number<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nid" name="nid" placeholder="Enter nid number" onblur="validate_nid()" onkeyup="validate_nid()">
                                                <label id="nid-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Date of Birth</label>
                                            <div class="col-sm-10">
                                                <div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
                                                    <input type="date" class="form-control" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" onchange="validate_dob()">
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



</body>

</html>