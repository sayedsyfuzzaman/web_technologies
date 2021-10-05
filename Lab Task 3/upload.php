<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Upload Image</title>
</head>

<body>
    <?php
    $fileDestination = $fileName = $fileTempName = $fileSize = $fileError = $fileType = "";

    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];

        //taking information of selected file
        $fileName = $_FILES['file']['name'];
        $fileTempName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if ($fileName != "") {
            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 4194304) {
                        //creating unique name of this image
                        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                        $fileDestination = 'images/' . $fileNameNew;
                        move_uploaded_file($fileTempName, $fileDestination);
                    } else {
                        echo "Your file is too big! It should not be more than 4MB.";
                    }
                } else {
                    echo "There was an error uploading your file!";
                }
            } else {
                echo "You cannot upload files of this type!";
            }
        } else {
            echo "No file choosen!";
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                <section class="copy">
                    <h1>Update Your Profile!</h1>
                    <span class="input-err"><?php echo "" ?></span>
                </section>

                <section class="radio-checkbox">
                    <div class="input-container">
                        <input id="image" type="file" name="file">

                        <button type="submit" name="submit">Upload Image</button>
                        <label for="image">Your Image</label>
                        <img src="
                        <?php
                        if ($fileDestination == "") {
                            echo "images\default.jpg";
                        } else {
                            echo  $fileDestination;
                        }
                        ?>" alt="" width="300px" height="300px"><br>
                        
                    </div>
                </section>
            </form>
        </div>
    </div>

</body>

</html>