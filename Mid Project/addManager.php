<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <link rel="stylesheet" href="styles\insidePortal.css">
    <title>Dashboard</title>
</head>


<body>
    <div class="split-screen">
        <?php
        include 'portal_header.php';
        include 'navigation_bar.php';

        $data = array(
            'name' => "",
            'email' => "",
            'phone' => "",
            'nationality' => "",
            'nid' => "",
            'dob' => "",
            'gender' => "",
            'address' => "",
            'image' => "",
        );
        $isValid = $nameErr = $emailErr = $phoneErr = $nationalityErr = $nidErr = $dobErr = $genderErr = $adderssErr = "";
        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            //phone number validation
            if(empty($_POST["phone"])){
                $phoneErr = "Phone number cannot be empty";
                $isValid = false;
            }
            elseif (preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $_POST["phone"]) != 1){
                $phoneErr = "Invalid phone number";
                $isValid = false;
            }
            elseif(strlen($_POST["phone"]) == 11){
                $phoneErr = "Phone number cannot be greate or less than 11";
                $isValid = false;
            }
            elseif($isValid = true){
                $phoneErr = "";
                $isValid = true;
            }

            //nationality validation
            if(empty($_POST["nationality"])){
                $nationalityErr = "Nationality cannot be empty";
                $isValid = false;
            }
            elseif(is_numeric($_POST["nationality"])) {
                $nationalityErr = "Nationality cannot contain numbers";
                $isValid = false;
            }
            elseif($isValid == true)
            {
                $nationalityErr = "";
                $isValid = true;
            }

            //dob validation
            

            //gender valiadion
            if (empty($_POST["gender"])) {
                $genderErr = "Please select your gender";
                $isValid = false;
            } elseif ($isValid == true) {
                $gender = test_input($_POST["gender"]);
                $isValid =  true;
            }

            //
        }
        ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <div class="page-title">
                <p>Add Manager</p>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="page-items">

                    <div class="block-one">
                        <div>
                            <label for="fname">Full Name:</label><br>
                            <input type="text" id="fname" name="fname" required><br>
                            <span class="inputErr"><?php echo $nameErr; ?></span>
                        </div>

                        <div>
                            <label for="email">Email:</label><br>
                            <input type="text" id="email" name="email" required><br>
                            <span class="inputErr"><?php echo $emailErr; ?></span>
                        </div>

                        <div>
                            <label for="phone">Phone Number:</label><br>
                            <input type="text" id="phone" name="phone" required><br>
                            <span class="inputErr"><?php echo $phoneErr; ?></span>
                        </div>

                        <div>
                            <label for="nationality">Nationality:</label><br>
                            <input type="text" id="nationality" name="nationality" required><br>
                            <span class="inputErr"><?php echo $nationalityErr; ?></span>
                        </div>

                        <div>
                            <label for="nid">NID Number:</label><br>
                            <input type="text" id="nid" name="nid" required><br>
                            <span class="inputErr"><?php echo $nidErr; ?></span>
                        </div>

                        <div>
                            <label for="dob">Date of Birth:</label><br>
                            <input type="date" max=<?= date('Y-m-d'); ?> id="dob" name="dob" required>
                            <span class="inputErr"><?php echo $dobErr; ?></span><br>
                        </div>
                    </div>

                    <div class="block-two">
                        <div>
                            <label for="gender">Gender:</label><br>
                            <input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label><br>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label><br>
                            <input type="radio" id="other" name="gender" value="other">
                            <label for="female">Other</label><br>
                            <span class="inputErr"><?php echo $genderErr; ?></span>
                        </div>

                        <div>
                            <label for="address">Address:</label><br>
                            <textarea id="address" name="address" required></textarea><br>
                            <span class="inputErr"><?php echo $adderssErr; ?></span>
                        </div>

                        <div>
                            <label for="image">Upload Professional Photo:</label><br>
                            <input accept="image/*" type='file' id="imgInp" required><br>
                            <img id="blah" src="#" alt="your image" style="width: 200px; height: 200px;" /><br><br>
                        </div>

                        <script>
                            imgInp.onchange = evt => {
                                const [file] = imgInp.files
                                if (file) {
                                    blah.src = URL.createObjectURL(file)
                                }
                            }
                        </script>
                    </div>


                </div>
                <div class="buttons-block">
                    <input type="submit" name="createStudent" value="Create">
                    <input type="reset">
                </div>
            </form>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
</body>

</html>