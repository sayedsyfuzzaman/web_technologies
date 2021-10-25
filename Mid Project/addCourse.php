<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>


<body>
    <?php

    session_start();
    if (!isset($_SESSION['id'])) {
		session_destroy();
		header("location:login.php");
	}
    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">

            <!-- Write your code here -->

            <div class="page-title">
                <p>Add Course</p>
            </div>
            <div class="page-items">
                <form action="controller/createStudent.php" method="POST" enctype="multipart/form-data">
                    <label for="cname">Course Name:</label><br>
                    <input type="text" id="cname" name="cname"><br>
                    <label for="ccategory">Course Category</label><br>
                    <select name="ccategory">
                        <option value="">Select...</option>
                        <option value="M">Category1</option>
                        <option value="F">Category2</option>
                    </select><br>

                    <label for="image">Course Thumbnail</label><br>
                    <img src="" alt="" style="width: 250px; height: 120px"><br>
                    <input type="file" name="image"><br><br>
                    <input type="submit" name="createStudent" value="Create">
                    <input type="reset">
                </form>
            </div>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
</body>

</html>