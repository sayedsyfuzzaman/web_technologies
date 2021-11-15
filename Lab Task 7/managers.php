<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Managers</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>
            <main class="content">
                <div class="container-fluid">

                    <div class="header">
                        <h1 class="header-title">
                            Blank Page
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Managers</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Default</h5>
                                    <h6 class="card-subtitle text-muted">Highly flexible tool that many advanced features to any HTML table.</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-basic" class=" table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Date of Birth</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <img src="img/avatars/avatar-5.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Michelle
                                                    Bilodeau
                                                </td>
                                                <td>864-348-0485</td>
                                                <td>June 21, 1961</td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle fas fa-fw fa-pen"></i></i></a>
                                                    <a href="#"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/avatars/avatar-2.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Alexander
                                                    Groves
                                                </td>
                                                <td>914-939-2458</td>
                                                <td>May 15, 1948</td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle fas fa-fw fa-pen"></i></i></a>
                                                    <a href="#"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/avatars/avatar-3.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Kathie
                                                    Burton
                                                </td>
                                                <td>704-993-5435</td>
                                                <td>September 14, 1965</td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle fas fa-fw fa-pen"></i></i></a>
                                                    <a href="#"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <img src="img/avatars/avatar-4.jpg" width="48" height="48" class="rounded-circle mr-2" alt="Avatar"> Daisy Seger
                                                </td>
                                                <td>765-382-8195</td>
                                                <td>April 2, 1971</td>
                                                <td class="table-action">
                                                    <a href="#"><i class="align-middle fas fa-fw fa-pen"></i></i></a>
                                                    <a href="#"><i class="align-middle fas fa-fw fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>Date of Birth</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include 'footer.php';
            ?>
        </div>
    </div>

    <!-- Javascript Start from here -->
    <script src="js/app.js"></script>

    <script>
        $(function() {
            // Datatables basic
            $('#datatables-basic').DataTable({
                responsive: true
            });
            // Datatables with Buttons
            var datatablesButtons = $('#datatables-buttons').DataTable({
                lengthChange: !1,
                buttons: ["copy", "print"],
                responsive: true
            });
            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
        });
    </script>

</body>

</html>