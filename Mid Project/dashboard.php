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

            <img src="resources/images/dashboard.png" alt="" style="width:100%">

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>