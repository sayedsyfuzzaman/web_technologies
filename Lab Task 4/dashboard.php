<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Dashboard</title>
</head>


<body>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
		session_destroy();
		header("location:login.php");
	}
    ?>
    <div class="split-screen">
        <?php include 'portal_header.php'; ?>
        <?php include 'navigation_bar.php' ?>
        <div class="portal-body">
            <p>Welcome to ProgSchool Portal</p>
        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>