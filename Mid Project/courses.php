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
            <h2>All Courses</h2>

            <table>
                <tr>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/cpp.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> C++<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/cpp.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> C++<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/cpp.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> C++<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/cpp.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> C++<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/python.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Python<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/python.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Python<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/python.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Python<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/python.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Python<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                </tr>
                <tr>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                            <img src="resources/images/java.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Java<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/java.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Java<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/java.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Java<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                    <div class="divPadding" style="">
                        <td class="main" style="width: 150px; padding-left:20px; padding-right:20px; padding-top: 10px; padding-bottom: 10px; height: 200px; text-align: center;">
                        <img src="resources/images/java.png" alt="cpp" style="width: 100px; height: 100px;">
                            <figcaption style="text-align: center;"> Java<br>
                                <div class="button" style="text-align: center;">
                                    <input type="submit" class="submit_button" value="View Course Module" style="text-align: center;">
                                </div>
                            </figcaption>

                        </td>
                    </div>
                </tr>
            </table>

            <!-- End your code here -->

        </div>
    </div>
    <?php include 'portal_footer.php'; ?>
    </div>
</body>

</html>