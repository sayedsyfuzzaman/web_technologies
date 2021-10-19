<html>

<head>
    <link rel="stylesheet" href="styles\style.css">
    <title>Portal Header</title>
</head>

<body>

    <?php
    $name = "";
    if (isset($_SESSION['name'])) {
        $name = $_SESSION['name'];
    }
    ?>
    <div class="portal-header">
        <div class="block-description-one">
            <a title="ProgSchool" href="dashboard.php" , style="font-size: x-large;">ProgSchool Portal</a>
        </div>
        <div class="block-description-two">
            <ul>
                <li><a href="">Welcome <?php echo $name ?></a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</body>