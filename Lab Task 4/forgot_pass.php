<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Forgot Password</title>
</head>

<body>

    <?php
    $emailErr = $email = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //getting data
        $email = $_POST["email"];

        $data = file_get_contents("data\users_data.json");
        $data = json_decode($data, true);

        if (!empty($data)) {
            foreach ($data as $row) {
                if (strcmp($row["email"], $_POST["email"]) == 0) {
                    $emailErr = "Email Found!";
                    break;
                } else {
                    $emailErr = "Email not Found!";
                }
            }
        }
    }
    ?>



    <div class="split-screen">
        <?php include 'client_header.php'; ?>
        <div class="right">

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <section class="copy">
                    <p>Forgot Password</p>
                </section>
                <div class="input-container email">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="someone@email.com" value=<?php echo $email ?>>
                    <span class="input-err"><?php echo $emailErr ?></span>
                </div>
                <button class="register-btn" type="submit">Check</button>
            </form>
        </div>
    </div>
    <?php include 'client_footer.php' ?>
</body>

</html>