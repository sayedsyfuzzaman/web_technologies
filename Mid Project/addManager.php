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


        session_start();
        if (!isset($_SESSION['id'])) {
            session_destroy();
            header("location:login.php");
        }

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
            'file' => "",
            'old_file' => "",
            'temp_name' => "",
            'size' => ""
        );

        $error = array(
            'name' => "",
            'email' => "",
            'phone' => "",
            'nationality' => "",
            'nid' => "",
            'dob' => "",
            'gender' => "",
            'address' => "",
            'pictureErr' => ""
        );

        $submissionErr = "";
        $submitted = false;
        $addManager = array(
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
            require_once 'C:/xampp/htdocs/web_technologies/Mid Project/controller/Manager.php';

            $gender = "";
            if (!empty($_POST["gender"])) {

                $gender = $_POST["gender"];
            }

            $target_file = $_FILES["fileToUpload"]["name"];


            $data = array(
                'name' => $_POST["fname"],
                'email' => $_POST["email"],
                'phone' => $_POST["phone"],
                'nationality' => $_POST["nationality"],
                'nid' => $_POST["nid"],
                'dob' => $_POST["dob"],
                'gender' => $gender,
                'address' => $_POST["address"],
                'file' =>  $target_file,
                'old_file' => "",
                'temp_name' => $_FILES["fileToUpload"]["tmp_name"],
                'size' => $_FILES["fileToUpload"]["size"],
                'filepath' => ""
            );


            $manager = new Manager();
            $addManager = $manager->validation($data);
            $error = $manager->errors;
        }
        ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <div class="page-title">
                <h2>Add Manager</h2>
            </div>
            <div class="after-submit">
                <p><?php if (!empty($addManager["id"])) {
                        echo "Manager Added Successfully!";
                        echo "ID: " . $addManager["id"];
                    } ?></p>
                <p><?php if (!empty($addManager["password"])) {
                        echo "Password: " . $addManager["password"];
                    } ?></p>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="page-items">

                    <div class="block-one">
                        <div>
                            <label for="fname">Full Name:</label><br>
                            <input type="text" id="fname" name="fname"><br>
                            <span class="inputErr"><?php echo $error["name"]; ?></span>
                        </div>

                        <div>
                            <label for="email">Email:</label><br>
                            <input type="text" id="email" name="email"><br>
                            <span class="inputErr"><?php echo $error["email"]; ?></span>
                        </div>

                        <div>
                            <label for="phone">Phone Number:</label><br>
                            <input type="text" id="phone" name="phone"><br>
                            <span class="inputErr"><?php echo $error["phone"]; ?></span>
                        </div>

                        <div>
                            <label for="nationality">Nationality:</label><br>
                            <input type="text" id="nationality" name="nationality"><br>
                            <span class="inputErr"><?php echo $error["nationality"]; ?></span>
                        </div>

                        <div>
                            <label for="nid">NID Number:</label><br>
                            <input type="text" id="nid" name="nid"><br>
                            <span class="inputErr"><?php echo $error["nid"]; ?></span>
                        </div>

                        <div>
                            <label for="dob">Date of Birth:</label><br>
                            <input type="date" max=<?= date('Y-m-d'); ?> id="dob" name="dob">
                            <span class="inputErr"><?php echo $error["dob"]; ?></span><br>
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
                            <span class="inputErr"><?php echo $error["gender"]; ?></span>
                        </div>

                        <div>
                            <label for="address">Address:</label><br>
                            <textarea id="address" name="address"></textarea><br>
                            <span class="inputErr"><?php echo $error["address"]; ?></span>
                        </div>

                        <div>
                            <label for="image">Upload Professional Photo:</label><br>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <span class="inputErr"><?php echo $error["pictureErr"]; ?></span>
                        </div>
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