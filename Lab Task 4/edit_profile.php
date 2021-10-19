<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>

<body>

    <?php
    session_start();
    $nameErr = $emailErr = $dobErr  = $genderErr = $final_err = $message = "";
    $name = $password  = $email = $dob = $gender = $picture = "";
    $username = $_SESSION["username"];
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (!isset($_SESSION['username'])) {
        session_destroy();
        header("location:login.php");
    } else {
        if (isset($_SESSION['username'])) {
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            $dob = $_SESSION['dob'];
            $gender = $_SESSION['gender'];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["fname"]);
            $email = test_input($_POST["email"]);

            if (empty($name)) {
                $nameErr = "Name is required";
            } else {
                if ((str_word_count($name)) < 2) {
                    $nameErr = "The name must have at least two word";
                } else {
                    if ((preg_match("/[A-Za-z]/", $name[0])) == 0) {
                        $nameErr = "The name must have start with litter";
                    } else {
                        if (preg_match('/^[A-Za-z\s._-]+$/', $name) !== 1) {
                            $nameErr = "Name can contain letter,desh,dot and space";
                        }
                    }
                }
            }

            if (empty($email)) {
                $emailErr = "Email is required";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
            }


            if (empty($_POST["dob"])) {
                $dobErr = "Date of Birth required";
            } else {
                if ($_POST["dob"] > date('Y-m-d')) {
                    $dobErr = "Invalide input";
                } else {
                    $dob = $_POST["dob"];
                }
            }


            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            } else {
                $gender = test_input($_POST["gender"]);
            }

            if (empty($nameErr) && empty($emailErr) && empty($genderErr)) {
                $data = file_get_contents("data\users_data.json");
                $data = json_decode($data, true);
                foreach ($data as $row) {
                    if ($row["username"] == $username) {
                        $data = file_get_contents("data\users_data.json");
                        $data = json_decode($data, true);
                        if (!empty($data)) {
                            foreach ($data as $key => $row) {
                                if ($row["username"] == $_SESSION['username']) {
                                    $data[$key]['name'] = $name;
                                    $_SESSION['name'] = $name;
                                    $data[$key]['email'] = $email;
                                    $_SESSION['email'] = $email;
                                    $data[$key]['dob'] = $dob;
                                    $_SESSION['dob'] = $dob;
                                    $data[$key]['gender'] = $gender;
                                    $_SESSION['gender'] = $gender;
                                    $message = "Information changed!";
                                    break;
                                }
                            }

                            file_put_contents('data\users_data.json', json_encode($data));
                        }
                        break;
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
            <div class="profile-container">

                <div class="title">
                    <p>Edit Profile</p>
                    <hr>
                </div>

                <div class="blocks">
                    <div class="block-one" style="width: 100%;">
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="fields">
                                <div class="name">
                                    <span>Name: </span>
                                </div>
                                <div class="value">
                                    <input type="text" name="fname" value="<?php echo $name ?>">
                                    <span class="input-err"><?php echo $nameErr ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="name">
                                    <span>Email: </span>
                                </div>
                                <div class="value">
                                    <input type="text" name="email" value="<?php echo $email ?>">
                                    <span class="input-err"><?php echo $emailErr ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="name">
                                    <span>Gender: </span>
                                </div>
                                <div class="value">
                                    <label for="male" class="radio-container">
                                        <input type="radio" id="male" name="gender" <?php if (isset($gender) && $gender == "male") {
                                                                                        echo "checked";
                                                                                    } elseif ($_SESSION['gender'] == "male") {
                                                                                        echo "checked";
                                                                                    } ?> value="male">
                                        <span class="radiomark"></span>
                                        Male
                                    </label>
                                    <label for="female" class="radio-container">
                                        <input type="radio" id="female" name="gender" <?php if (isset($gender) && $gender == "female") {
                                                                                            echo "checked";
                                                                                        } elseif ($_SESSION['gender'] == "female") {
                                                                                            echo "checked";
                                                                                        } ?> value="female">
                                        <span class="radiomark"></span>
                                        Female
                                    </label>
                                    <label for="other" class="radio-container">
                                        <input type="radio" id="other" name="gender" <?php if (isset($gender) && $gender == "other") {
                                                                                            echo "checked";
                                                                                        } elseif ($_SESSION['gender'] == "other") {
                                                                                            echo "checked";
                                                                                        } ?> value="other">
                                        <span class="radiomark"></span>
                                        Prefer not to say
                                    </label>
                                    <span class="input-err"><?php echo  $genderErr ?></span>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="name">
                                    <span>Date of birth: </span>
                                </div>
                                <div class="value">
                                    <input type="date" name="dob" max="<?= date('Y-m-d'); ?>" value="<?php if (empty($dob)) {
                                                                                                            echo $_SESSION['dob'];
                                                                                                        } else {
                                                                                                            echo $dob;
                                                                                                        } ?>">
                                </div>
                                <span class="input-err"><?php echo $dobErr ?></span>
                            </div>
                            <hr>
                            <span class="input-valid"><?php echo $message ?></span>
                            <button class="portal-btn" type="submit">Submit</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
</body>

</html>