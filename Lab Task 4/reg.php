<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Register a new account</title>

<body>

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $dobErr  = $genderErr = $usernameErr = $passErr = $confirm_passErr =  $final_err = "";
    $name = $email =  $dob = $gender = $username = $password = "";

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = false;

        $name =  test_input($_POST["fname"]);
        $email =  test_input($_POST["email"]);

        //name validation
        if (empty($_POST["fname"])) {
            $nameErr =  "Name can not be empty";
            $isValid = false;
        } elseif (str_word_count($_POST["fname"]) < 2) {
            $nameErr = "Cannot contain less than two words";
            $isValid = false;
        } elseif (preg_match("/[A-Za-z]/", $_POST["fname"][0]) == 0) {
            $nameErr = "Must start with a letter";
            $isValid = false;
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $_POST["fname"]) !== 1) {
            $nameErr = "Can contain a-z, A-Z, period and dash only";
            $isValid = false;
        } else {
            $name = test_input($_POST["fname"]);
            $isValid = true;
        }

        //email validation
        if (empty($_POST["email"])) {
            $emailErr =  "Email can not be empty";
            $isValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr =  "Invalid email format";
            $isValid = false;
        } elseif ($isValid == true) {
            $email = test_input($_POST["email"]);
            $isValid = true;
        }



        //date of birth validation
        if ($_POST["dd"] == "none" or $_POST["mm"] == "none" or $_POST["yyyy"] == "none") {
            $dobErr = "Please input a valid date";
            $isValid = false;
        } elseif ($isValid == true) {
            $dob = test_input($_POST["dd"]) . "-" . test_input($_POST["mm"]) . "-" . test_input($_POST["yyyy"]);
            $isValid = true;
        }



        //password validation
        if (strcmp($_POST["pass"], $_POST["confirm_pass"]) != 0) {
            $isValid = false;
            $confirm_passErr = "Password is not same";
        } elseif (strlen($_POST["pass"]) < 8) {
            $isValid = false;
            $passErr = "Password must not be less than 8 character";
        } elseif (preg_match('/[#$%@]/', $_POST["pass"]) !== 1) {
            $isValid = false;
            $passErr = "At least one special character needed";
        } elseif ($isValid == true) {
            $isValid =  true;
            $password = test_input($_POST["pass"]);
        }

        //username validation
        if (strlen($_POST["username"]) < 2) {
            $usernameErr = "Cannot contain less than two words";
            $isValid = false;
        } elseif (preg_match('/^[A-Za-z0-9\s.-]+$/', $_POST["username"]) !== 1) {
            $usernameErr = "Can contain alpha numeric characters, period, dash or underscore only";
            $isValid = false;
        } elseif ($isValid == true) {
            $username = test_input($_POST["username"]);
            $isValid = true;
        }

        //gender valiadion
        if (empty($_POST["gender"])) {
            $genderErr = "Please select your gender";
            $isValid = false;
        } elseif ($isValid == true) {
            $gender = test_input($_POST["gender"]);
            $isValid =  true;
        }

        //getting data
        $data = file_get_contents("data\users_data.json");
        $data = json_decode($data, true);
        $emailFound = false;
        $usernameFound = false;

        if (!empty($data)) {
            foreach ($data as $row) {
                if (strcmp($row["email"], $email) == 0) {
                    $emailFound = true;
                    break;
                }
            }
            foreach ($data as $row) {
                if (strcmp($row["username"], $username) == 0) {
                    $usernameFound = true;
                    break;
                }
            }
        }


        if ($emailFound == true) {
            $final_err = "You are already a user";
            $isValid = false;
            $nameErr = $emailErr = $degreeErr = $dobErr = $bloodGroupErr = $genderErr = $usernameErr = $passErr = $confirm_passErr  = "";
        } elseif ($usernameFound == true) {
            $isValid = false;
            $usernameErr = "Username is not available, Try another";
        }


        if ($isValid == true and file_exists("data\users_data.json")) {
            $current_data = file_get_contents('data\users_data.json');
            $array_data = json_decode($current_data, true);
            $new_data = array(
                'name'      => $name,
                'email'     => $email,
                'username'  => $username,
                'password'  => $password,
                'dob'       => $dob,
                'gender'    => $gender,
            );
            $array_data[] = $new_data;
            $final_data = json_encode($array_data);
            if (file_put_contents('data\users_data.json', $final_data)) {
                echo "File appended successfully!";
            } else {
                echo "Error!";
            }
        }
    }
    ?>

    <div class="split-screen">
        <?php include 'client_header.php';?>
        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <section class="copy">
                    <h1>Register</h1>
                    <p>Already have an an account?
                        <a href="login.php">
                            <strong>Log In</strong>
                        </a>
                    </p>

                    <span class="input-err"><?php echo $final_err ?></span>
                </section>
                <div class="input-container name">
                    <label for="fname">Full Name</label>
                    <input id="fname" name="fname" type="text" placeholder="Sayed Syfuzzaman">
                    <span class="input-err"><?php echo $nameErr ?></span>
                </div>

                <div class="input-container email">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="someone@email.com">
                    <span class="input-err"><?php echo $emailErr ?></span>
                </div>

                <div class="input-container username">
                    <label for="username">Username</label>
                    <input id="username" name="username" type="text" placeholder="At least 2 character">
                    <span class="input-err"><?php echo $usernameErr ?></span>
                </div>

                <div class="input-container password">
                    <label for="pass">Password</label>
                    <input id="pass" name="pass" type="password" placeholder="At least 8 character and one special character">
                    <span class="input-err"><?php echo $passErr ?></span>
                </div>

                <div class="input-container confirm_pass">
                    <label for="confirm_pass">Retype Password</label></label>
                    <input id="confirm_pass" name="confirm_pass" type="password" placeholder="Confirm your password">
                    <span class="input-err"><?php echo $confirm_passErr ?></span>
                </div>

                <section class="dob">
                    <label>Date of birth</label>
                    <div class="date">
                        <div class="date-container" style="width: calc(100% / 4 - 5px)">
                            <select name="dd" id="dd">
                                <option value="none" selected>Day</option>
                                <option value='01'>01</option>
                                <option value='02'>02</option>
                                <option value='03'>03</option>
                                <option value='04'>04</option>
                                <option value='05'>05</option>
                                <option value='06'>06</option>
                                <option value='07'>07</option>
                                <option value='08'>08</option>
                                <option value='09'>09</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                                <option value='15'>15</option>
                                <option value='16'>16</option>
                                <option value='17'>17</option>
                                <option value='18'>18</option>
                                <option value='19'>19</option>
                                <option value='20'>20</option>
                                <option value='21'>21</option>
                                <option value='22'>22</option>
                                <option value='23'>23</option>
                                <option value='24'>24</option>
                                <option value='25'>25</option>
                                <option value='26'>26</option>
                                <option value='27'>27</option>
                                <option value='28'>28</option>
                                <option value='29'>29</option>
                                <option value='30'>30</option>
                                <option value='31'>31</option>
                            </select>
                        </div>

                        <div class="date-container" style="width: calc(100% / 2.5 - 5px)">
                            <select name="mm" id="mm">
                                <option value="none" selected>Month</option>
                                <option value='01'>January</option>
                                <option value='02'>February</option>
                                <option value='03'>March</option>
                                <option value='04'>April</option>
                                <option value='05'>May</option>
                                <option value='06'>June</option>
                                <option value='07'>July</option>
                                <option value='08'>August</option>
                                <option value='09'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <div class="date-container" style="width: calc(100% / 3.5 - 5px)">
                            <?php
                            // used this to set an option as selected
                            $already_selected_value = 1984;
                            $earliest_year = (int)date('Y') - 100;

                            print '<select name="yyyy" id = "yyyy">';
                            foreach (range($earliest_year, date('Y')) as $x) {
                                print '<option value="' . $x . '"' . '>' . $x . '</option>';
                            }
                            print '<option value="none" selected>Year</option>';
                            print '</select>';
                            ?>
                        </div>
                    </div>
                    <span class="input-err"><?php echo $dobErr ?></span>
                </section>


                <section class="radio-checkbox">
                    <div class="gender">
                        <label>Gender</label>
                        <label for="male" class="radio-container">
                            <input type="radio" id="male" name="gender" value="male">
                            <span class="radiomark"></span>
                            Male
                        </label>
                        <label for="female" class="radio-container">
                            <input type="radio" id="female" name="gender" value="female">
                            <span class="radiomark"></span>
                            Female
                        </label>
                        <label for="other" class="radio-container">
                            <input type="radio" id="other" name="gender" value="other">
                            <span class="radiomark"></span>
                            Prefer not to say
                        </label>
                        <span class="input-err"><?php echo  $genderErr ?></span>
                    </div>

                </section>

                <button class="register-btn" type="submit">Register</button>

                <section class="copy legal">
                    <p><span>By continuing, you agree to accept our <br> <a href="#">Privacy Policy</a></span></p>
                </section>
            </form>
        </div>
    </div>
    <?php include 'client_footer.php' ?>
</body>

</html>