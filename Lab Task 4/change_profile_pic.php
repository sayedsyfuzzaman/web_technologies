<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>

<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    }
    $pictureErr = $passwordErr = $confirm_passwordErr = "";
    $ImageError = $UploadConfirmation = "";
    $target_file = "";
    $old_file = $_SESSION['picture'];
    $mypic = "";

    if (isset($_POST['submit'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";
        if ($_FILES['fileToUpload']['name'] != "") {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {

                $uploaded = 1;
            } else {
                $ImageError = "File is not an image.";
                $uploaded = 0;
            }

            if (file_exists($target_file)) {
                $ImageError = "File already exists.";
                $uploaded = 0;
            }

            if ($_FILES["fileToUpload"]["size"] > 40000000000) {
                $ImageError = "Sorry, your file is too large.";
                $uploaded = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $ImageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = 0;
            }

            if ($uploaded == 0) {
                $ImageError = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    $mypic = $target_file;
                    $UploadConfirmation = "File has been uploaded Successfully";
                    if ($old_file != "") {
                        unlink($old_file);
                    }
                    $filepath = $target_dir . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));

                    $data = file_get_contents("data\users_data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $key => $row) {
                            if ($row["username"] == $_SESSION['username']) {
                                $data[$key]['picture'] = $filepath;
                                $_SESSION['picture'] = $filepath;
                                break;
                            }
                        }

                        file_put_contents('data\users_data.json', json_encode($data));
                    }
                } else {
                    $ImageError = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $ImageError = "No Image was selected";
        }
    }
    ?>

    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <div class="chng-pic-container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <p>Change Image</p>
                    <img src="<?php if (!empty($_SESSION['picture'])) {
                                    echo $_SESSION['picture'];
                                } else {
                                    echo "images\default.jpg";
                                } ?>" alt="" width="300px" height="300px"><br>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <span>
                        <?php
                        if ($ImageError !== "") {
                            echo ($ImageError);
                        }
                        ?>
                    </span>
                    <input class="portal-submit-btn" type="submit" name="submit" class="submit_button" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <?php include 'client_footer.php'; ?>
</body>

</html>