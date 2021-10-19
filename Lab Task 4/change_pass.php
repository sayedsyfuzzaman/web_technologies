<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Change Password</title>
</head>

<body>
    <?php
    session_start();
    $passwordErr = $new_passwordErr = $username = $confirm_passwordErr = $message = $error = "";
    $password = $new_password = $confirm_password  = "";

    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    } 
    elseif (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $password = $_POST["current-pass"];
        $new_password = $_POST["new-pass"];
        $confirm_password = $_POST["retype-pass"];



        if (empty($password)) {
            $passwordErr = "Password is required";
        } else {
            if (strlen($password) < 8) {
                $passwordErr = "Password must contain at least 8 character";
            } else {

                if (preg_match('/[#$%@]/', $password) !== 1) {
                    $passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                } else {
                    $data = file_get_contents("data\users_data.json");
                    $data = json_decode($data, true);
                    if (!empty($data)) {
                        foreach ($data as $row) {
                            if ($row["username"] == $username && $password != $row["password"]) {

                                $passwordErr = "Invalid password";
                                break;
                            } elseif ($row["username"] == $username && $password == $row["password"]) {
                                if (empty($new_password)) {
                                    $new_passwordErr = "Password is required";
                                } else {
                                    if (strlen($new_password) < 8) {
                                        $new_passwordErr = "Password must contain at least 8 character";
                                    } else {

                                        if (preg_match('/[#$%@]/', $new_password) !== 1) {
                                            $new_passwordErr = "Password have to contain at least one '#' or '$' or '%' or '@'";
                                        } else {
                                            if (empty($confirm_password)) {
                                                $confirm_passwordErr = "Confirm Password is required";
                                            } else {
                                                if (strcmp($new_password, $confirm_password) !== 0) {
                                                    $confirm_passwordErr = "Password are not matched";
                                                } else {
                                                    $data = file_get_contents("data\users_data.json");
                                                    $data = json_decode($data, true);
                                                    if (!empty($data)) {
                                                        foreach ($data as $key => $row) {
                                                            if ($row["username"] == $_SESSION['username']) {
                                                                $data[$key]['password'] = $new_password;
                                                                $_SESSION['password'] = $new_password;
                                                                $message = "Password changed!";
                                                                break;
                                                            }
                                                        }

                                                        file_put_contents('data\users_data.json', json_encode($data));
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    ?>

    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <div class="title">
                <p>Change Password</p>
                <hr>
            </div>

            <div class="blocks">
                <div class="block-one" style="width: 100%;">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="fields">
                            <div class="name">
                                <span>Current Password: </span>
                            </div>
                            <div class="value">
                                <input name="current-pass" type="text" value="<?php echo $password; ?>">
                                <span class="input-err"><?php echo $passwordErr ?></span>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="name">
                                <span>New Password: </span>
                            </div>
                            <div class="value">
                                <input name="new-pass" type="text" value="<?php echo $new_password; ?>">
                                <span class="input-err"><?php echo $new_passwordErr ?></span>
                            </div>
                        </div>

                        <div class="fields">
                            <div class="name">
                                <span>Retype Password: </span>
                            </div>
                            <div class="value">
                                <input name="retype-pass" type="text" value="<?php echo $confirm_password; ?>">
                                <span class="input-err"><?php echo $confirm_passwordErr ?></span>
                            </div>
                        </div>
                       
                        <button class="portal-btn" type="submit">Change</button>
                        <section class="copy">
                    </form>
                    <span class="input-valid"><?php echo $message ?></span>
                </div>
            </div>
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
</body>

</html>