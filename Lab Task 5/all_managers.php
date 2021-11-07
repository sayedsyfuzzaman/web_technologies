<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Managers Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/style.css">

</head>

<body>

    <?php
    require_once 'controller/manager.php';

    $controller = new Manager();
    $managerInfo = $controller->fetchAllManager();

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        
        if ($controller->deleteManager($_GET['id'])) {
            header('Location: all_managers.php?status=deleted');
        }
      }
    ?>

    <div class="container mb-3 mt-3 bg-light shadow">

        <table id="example" class="table table-striped "  style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Id</th>
                    <th>Joining date</th>
                    <th>View More</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($managerInfo as $row) : ?>
                    <tr>
                        <td> <img style="height: 40px; height: 40px;" src="<?php echo $row["image"]; ?>" alt="<?php echo $row['lastname'] ?>"> </td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["reg_date"]; ?></td>
                        <td>
                            <button type="button" class="btn btn-outline-primary" onclick="window.location.href='edit_manager.php?id=<?php echo $row['id'] ?>'">View and Edit</button>
                            
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="window.location.href='all_managers.php?id=<?php echo $row['id'] ?>'"  >Delete</button>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Id</th>
                    <th>Joining date</th>
                    <th>View More</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>