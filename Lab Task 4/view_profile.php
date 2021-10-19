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
    } else {
        $name = $username = $password  = $email = $dob = $picture = "";

        if (isset($_SESSION['username'])) {
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $dob = $_SESSION['dob'];
            $gender = $_SESSION['gender'];
            $picture = $_SESSION['picture'];
        }
    }
    ?>

    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <div class="profile-container">

                <div class="title">
                    <p><?php echo $name ?></p>
                    <hr>
                </div>

                <div class="blocks">
                    <div class="block-one">
                        <div class="fields">
                            <div class="name">
                                <span>Email: </span>
                            </div>
                            <div class="value">
                                <span><?php echo $email ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="fields">
                            <div class="name">
                                <span>Gender: </span>
                            </div>
                            <div class="value">
                                <span><?php echo $gender ?></span>
                            </div>
                        </div>
                        <hr>
                        <div class="fields">
                            <div class="name">
                                <span>Date of birth: </span>
                            </div>
                            <div class="value">
                                <span><?php echo $dob ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="block-two">
                        <img src="<?php if (!empty($picture)) {
                                        echo $picture;
                                    } else {
                                        echo "images\default.jpg";
                                    } ?>" alt="" width="200px" height="200px"><br>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>