<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Login to Continue</title>
</head>

<body>

    <?php
    $userErr = $usernameErr = $passwordErr = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isUser = false;
        $isvalid = false;

        //username validation
        if (strlen($_POST["username"]) < 2) {
            $usernameErr = "Cannot contain less than two words";
            $isvalid = false;
        } elseif (preg_match('/^[A-Za-z0-9\s.-]+$/', $_POST["username"]) !== 1) {
            $usernameErr = "Can contain alpha numeric characters, period, dash or underscore only";
            $isvalid = false;
        } else {
            $usernameErr = "";
            $isvalid = true;
        }


        if (strlen($_POST["password"]) < 8) //password validation
        {
            $passwordErr = "Password must not be less than 8 character";
            $isvalid = false;
        } elseif (preg_match('/[#$%@]/', $_POST["password"]) !== 1) {
            $passwordErr = "At least one special character needed";
            $isvalid = false;
        } elseif ($isvalid == true) {
            $passwordErr = "";
            $isvalid = true;
        }


        if ($isvalid == true) {
            //getting data

            $data = file_get_contents("data\users_data.json");
            $data = json_decode($data, true);

            if (!empty($data)) {
                foreach ($data as $row) {
                    if (strcmp($row["username"], $_POST["username"]) == 0) {
                        $usernameFound = true;
                        if (strcmp($row["password"], $_POST["password"]) == 0) {
                            $isUser = true;
                            break;
                        }
                    }
                }
            }

            if ($isUser == false) {
                $userErr = "Invalid Credentials";
            } else {
                $userErr = "Signing in.....";
            }
        }
    }
    ?>


    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Learn to code Free</h1>
                <p>Read tutorials, try examples, write programs, and learn to code.</p>
            </section>
        </div>
        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <section class="copy">
                    <h1>Welcome Back!</h1>
                    <p>Get the skills you need for the future of work</p>
                    <span class="input-err"><?php echo $userErr ?></span>
                </section>
                <div class="input-container name">
                    <label for="username">User Name</label>
                    <input id="username" name="username" type="text" placeholder="Enter your username">
                    <span class="input-err"><?php echo $usernameErr ?></span>
                </div>

                <div class="input-container password">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password">
                    <span class="input-err"><?php echo $passwordErr ?></span>
                </div>

                <label for="remember" class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember" value="remember">
                    <span class="checkmark"></span>
                    Remember Me
                </label>

                <button class="register-btn" type="submit">Sign in</button>
                <section class="copy">
                    <p><span><a href="forgot_pass.php">forgotten password?</a></span></p>
                </section>
            </form>
        </div>

        <div class="right">
            <section class="copy legal">
                <form method="post" action="#">
                    <p><span>Or <a href="reg.php"><strong>click here</strong></a> to create an account</span></p>
                </form>
            </section>
        </div>
    </div>
</body>

</html>