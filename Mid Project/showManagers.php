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
        require_once 'controller/Manager.php';

        $manager = new Manager();
        $managerInfo = $manager->showAllManager();

        ?>

        <div class="portal-body">

            <!-- Write your code here -->
            <h2>Managers Information</h2>
            <a href="controller/ManagerReport.php">Generate Report</a>

            <table id="managers">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Id</th>
                    <th>Action</th>
                </tr>

                <?php foreach ($managerInfo as $row) : ?>
                    <tr>

                        <td> <img src="<?php echo $row["picture"]; ?>" alt="<?php echo $row['name'] ?>"> </td>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["id"]; ?></td>
                        <td><a href="editManager.php?id=<?php echo $row['id'] ?>">Edit</a>&nbsp
                            <a href="controller/deleteManager.php?id=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure want to delete this ?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>


            </table>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
</body>

</html>