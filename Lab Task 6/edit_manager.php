<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <title>Update Manager</title>
</head>

<body>

  <?php

  session_start();
  if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:sign-in.php");
  }

  require_once 'controller/manager.php';

  $manager = new Manager();
  $managerInfo = array(
    'id' => "",
    'fname' => "",
    'lname' => "",
    'email' => "",
    'phone' => "",
    'nationality' => "",
    'nid' => "",
    'dob' => "",
    'gender' => "",
    'address' => "",
    'image' => ""
  );
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $managerInfo = $manager->fetchManager($_GET["id"]);
  }

  $data = array(
    'id' => "",
    'password' => "",
    'fname' => "",
    'lname' => "",
    'email' => "",
    'phone' => "",
    'nationality' => "",
    'nid' => "",
    'dob' => "",
    'gender' => "",
    'address' => "",
    'file' => "",
    'old_file' => "",
    'temp_name' => "",
    'size' => ""
  );

  $error = array(
    'fname' => "",
    'lname' => "",
    'email' => "",
    'phone' => "",
    'nationality' => "",
    'nid' => "",
    'dob' => "",
    'gender' => "",
    'address' => "",
    'pictureErr' => ""
  );

  $UpdateStatus = "";

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'controller/manager.php';

    $gender = "";
    if (!empty($_POST["gender"])) {

      $gender = $_POST["gender"];
    }

    $target_file = $_FILES["fileToUpload"]["name"];

    $data = array(
      'id' => $managerInfo["id"],
      'fname' => $_POST["fname"],
      'lname' => $_POST["lname"],
      'email' => $_POST["email"],
      'phone' => $_POST["phone"],
      'nationality' => $_POST["nationality"],
      'nid' => $_POST["nid"],
      'dob' => $_POST["dob"],
      'gender' => $gender,
      'address' => $_POST["address"],
      'file' =>  $target_file,
      'old_file' => "",
      'temp_name' => $_FILES["fileToUpload"]["tmp_name"],
      'size' => $_FILES["fileToUpload"]["size"],
      'filepath' => "",
      'imageSelected' => ""
    );
    if (empty($_FILES["fileToUpload"]["name"])) {
      $data["imageSelected"] = "none";
      $data["filepath"] = $managerInfo["image"];
    }

    $manager = new Manager();
    $UpdateStatus = $manager->updateManager($data);
    $error = $manager->errors;
  }
  ?>

  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="signup-form">
          <form action="edit_manager.php?id=<?php echo $managerInfo['id'] ?>" method="POST" enctype="multipart/form-data" class="mt-5 border p-4 bg-light shadow">
            <h4 class="mb-5 text-secondary">Update Manager Account</h4>

            <?php
            if ($UpdateStatus == "updated") {
              header("Location: edit_manager.php?id=" . $managerInfo["id"] . "&status=updated");
            } elseif ($UpdateStatus == "failed") {
              echo "<div class='mb-5  d-flex justify-content-center'>
              <b class='text-danger'>Sorry! There was an error updating your account.</b>
            </div>";
            }
            if (isset($_GET['status']) && !empty($_GET['status'])) {
              if ($_GET['status'] == "updated") {
                echo "<div class='mb-5  d-flex justify-content-center'>
                <b class='text-success'>Account Updated!</b>
              </div>";
              }
            }
            ?>


            <div class="d-flex justify-content-center">
              <img class="form-control" src="<?php echo $managerInfo["image"] ?>" style="width: 100px; height: 100px;" alt="">
            </div>

            <div class="d-flex justify-content-center">
              <h4 class="text-dark"><?php echo $managerInfo["lname"] ?></h4>
            </div>

            <div class="d-flex justify-content-center">
              <p class="text-dark"><?php echo "ID: " . $managerInfo["id"] ?></p>
            </div>

            <div class="row">
              <div class="mb-3 col-md-6">
                <label>First Name<span class="text-danger">*</span></label>
                <input type="text" name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo $managerInfo["fname"]; ?>" />
                <span class="text-danger"><?php echo $error["fname"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Last Name<span class="text-danger">*</span></label>
                <input type="text" name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo $managerInfo["lname"]; ?>" />
                <span class="text-danger"><?php echo $error["lname"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Email<span class="text-danger">*</span></label>
                <input type="text" name="email" class="form-control" placeholder="someone@email.com" value="<?php echo $managerInfo["email"]; ?>" />
                <span class="text-danger"><?php echo $error["email"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Phone Number<span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="<?php echo $managerInfo["phone"]; ?>" />
                <span class="text-danger"><?php echo $error["phone"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Nationality<span class="text-danger">*</span></label>
                <input type="text" name="nationality" class="form-control" placeholder="Enter Nationality" value="<?php echo $managerInfo["nationality"]; ?>" />
                <span class="text-danger"><?php echo $error["nationality"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>NID Number<span class="text-danger">*</span></label>
                <input type="text" name="nid" class="form-control" placeholder="Enter NID Number" value="<?php echo $managerInfo["nid"]; ?>" />
                <span class="text-danger"><?php echo $error["nid"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Date of birth<span class="text-danger">*</span></label>
                <input type="date" name="dob" class="form-control" value="<?php echo $managerInfo["dob"]; ?>" />
                <span class="text-danger"><?php echo $error["dob"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Gender<span class="text-danger">*</span></label><br />
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" <?php if ($managerInfo["gender"] == "male") echo "checked"; ?> />
                  <label class="form-check-label" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" <?php if ($managerInfo["gender"] == "female") echo "checked"; ?> />
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="other" <?php if ($managerInfo["gender"] == "other") echo "checked"; ?> />
                  <label class="form-check-label" for="inlineRadio3">Other</label>
                </div>
                <span class="text-danger"><?php echo $error["gender"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label for="Image" class="form-label">Upload Photo</label>
                <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
                <span class="text-danger"><?php echo $error["pictureErr"]; ?></span>
              </div>

              <div class="mb-3 col-md-6">
                <label>Address<span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="1"><?php echo $managerInfo["address"]; ?></textarea>
                <span class="text-danger"><?php echo $error["address"]; ?></span>
              </div>

              <div class="col-md-12">

                <input type="submit" class="btn btn-primary float-end" value="Update">
                <input type="reset" name="reset" class="btn btn-light float-end" value="Reset">
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>

</html>