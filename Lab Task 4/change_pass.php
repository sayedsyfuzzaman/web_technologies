<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Change Password</title>
</head>

<body>

    <?php
    $currPass = "abc@1234";
    $currpasswordErr =  $newpasswordErr = $retypepasswordErr = $status = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (strcmp($_POST["current-pass"], $currPass) != 0) {
            $currpasswordErr = "Current password dosen't matched";
        } elseif (strcmp($_POST["new-pass"],  $currPass) == 0) {
            $newpasswordErr = "New password should not be same as the Current Password";
        } elseif (strcmp($_POST["retype-pass"], $_POST["new-pass"]) == 0) {
            $retypepasswordErr = "New Password must match with the Retyped Password";
        } else {
            $status = "Password Changed!";
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
                    <h1>Change Password</h1>
                    <p>It's a good idea to use a strong password that you dont use elsewhere</p>
                    <span class="input-err" style="color: blue;"><?php echo $status ?></span>
                </section>
                <div class="input-container current-pass">
                    <label for="current-pass">Current Password</label>
                    <input id="current-pass" name="current-pass" type="password" placeholder="Enter your current passsword">
                    <span class="input-err"><?php echo $currpasswordErr ?></span>
                </div>
                <div class="input-container new-pass">
                    <label for="new-pass">New Password</label>
                    <input id="new-pass" name="new-pass" type="password" placeholder="Enter your new passsword">
                    <span class="input-err"><?php echo $newpasswordErr ?></span>
                </div>
                <div class="input-container retype-pass">
                    <label for="retype-pass">Retype Password</label>
                    <input id="retype-pass" name="retype-pass" type="password" placeholder="Retype your new password">
                    <span class="input-err"><?php echo $retypepasswordErr ?></span>
                </div>

                <button class="register-btn" type="submit">Change</button>
                <section class="copy">
            </form>
        </div>
    </div>
</body>

</html>