<html>

<head>
    <link rel="stylesheet" href="styles\login.css">
    <title>Login to Continue</title>
</head>

<body>


    <?php
    $time = time();
    $count = 0;

    if (isset($_COOKIE['invalid'])) {
        $count = $_COOKIE['invalid'];
    } else {
        setcookie('invalid', 0);
    }

    $userErr = "";
    $data = array(
        'id' => "",
        'password' => ""
    );

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $data = array(
            'id' => test_input($_POST["id"]),
            'password' => $_POST["password"]
        );

        if ($count < 3) {
            if (!empty($_POST["id"]) and !empty($_POST["password"])) {
                require_once "C:/xampp/htdocs/web_technologies/Mid Project/controller/authentication.php";

                $authentication = new authentication();
                $isUser = $authentication->authenticateUser($data);

                if ($isUser == false) {
                    $count = $count + 1;
                    setcookie('invalid', $count, time()+30);
                    $userErr =  "Invalid id or password!";
                }
            } else {
                $userErr =  "Username or password cannot be empty!";
            }

            if (!empty($_POST['remember'])) {

                setcookie("id", $_POST['id'], time() + 10);
                setcookie("password", $_POST['password'], time() + 10);
            }
        }
        else
        {
            $userErr =  "Too many login attempts, Please try again later.";
        }
    }

    ?>
    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>ProgSchool Portal</h1>
            </section>
            <div class="block-description-two">
            <ul>
                <li style="color: #ffff;"><a href="home.php">Home</a></li>
            </ul>
        </div>
        </div>
        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <section class="copy">
                    <h1>Welcome Back!</h1>
                    <p>Login to continue.</p>
                    <span class="input-err"><?php echo $userErr ?></span>
                </section>
                <div class="input-container name">
                    <label for="id">ID</label>
                    <input id="id" name="id" type="text" placeholder="Enter your id" value="<?php if (isset($_COOKIE['id'])) {
                                                                                                echo $_COOKIE['id'];
                                                                                            } else {
                                                                                                echo $data["id"];
                                                                                            } ?>">
                </div>

                <div class="input-container password">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" placeholder="Enter your password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                        echo $_COOKIE['password'];
                                                                                                                    } else {
                                                                                                                        echo $data["password"];
                                                                                                                    } ?>">
                </div>

                <label for="remember" class="checkbox-container">
                    <input type="checkbox" id="remember" name="remember" value="remember">
                    <span class="checkmark"></span>
                    Remember Me
                </label>

                <button class="register-btn" type="submit" name="login">Sign in</button>
                <section class="copy">
                    <p>If you forgot your password contact with IT support.</p>
                </section>
            </form>
        </div>
    </div>
</body>

</html>