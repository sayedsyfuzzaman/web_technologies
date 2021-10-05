<html>

<head>
    <link rel="stylesheet" href="css\style.css">
    <title>Register a new account</title>

<body>

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $degreeErr = $dobErr = $bloodGroupErr = $genderErr = "";
    $name = $email = $degree1 = $degree2 = $degree3 = $degree4 = $bloodGroup = $dob = $gender = "";

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $isValid = false;

        $name =  test_input($_POST["fname"]);
        $email =  test_input($_POST["email"]);

        //name validation
        if (empty($_POST["fname"])) {
            $nameErr =  "Name can not be empty";
            $isValid = false;
        } elseif (str_word_count($_POST["fname"]) < 2) {
            $nameErr = "Cannot contain less than two words";
            $isValid = false;
        } elseif (preg_match("/[A-Za-z]/", $_POST["fname"][0]) == 0) {
            $nameErr = "Must start with a letter";
            $isValid = false;
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $_POST["fname"]) !== 1) {
            $nameErr = "Can contain a-z, A-Z, period and dash only";
            $isValid = false;
        } else {
            $name = test_input($_POST["fname"]);
            $isValid = true;
        }

        //email validation
        if (empty($_POST["email"])) {
            $emailErr =  "Email can not be empty";
            $isValid = false;
        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $emailErr =  "Invalid email format";
            $isValid = false;
        } else {
            $email = test_input($_POST["email"]);
            $isValid = true;
        }

        //degree validion
        $count = 4;

        if (empty($_POST["degree1"])) {
            $count -= 1;
        } else {
            $degree1 = test_input($_POST["degree1"]);
        }

        if (empty($_POST["degree2"])) {
            $count -= 1;
        } else {
            $degree2 = test_input($_POST["degree2"]);
        }

        if (empty($_POST["degree3"])) {
            $count -= 1;
        } else {
            $degree3 = test_input($_POST["degree3"]);
        }
        if (empty($_POST["degree4"])) {
            $count -= 1;
        } else {
            $degree4 = test_input($_POST["degree4"]);
        }

        if ($count < 2) {
            $degree1 = "";
            $degree2 = "";
            $degree3 = "";
            $degree4 = "";
            $degreeErr = "At least two degree must be selected";
            $isValid =  false;
        } else {
            $degreeErr = "";
            $isValid = true;
        }

        //date of birth validation
        if ($_POST["dd"] == "none" or $_POST["mm"] == "none" or $_POST["yyyy"] == "none") {
            $dobErr = "Please input a valid date";
            $isValid = false;
        } else {
            $dob = test_input($_POST["dd"]) . "/" . test_input($_POST["mm"]) . "/" . test_input($_POST["yyyy"]);
            $isValid = true;
        }

        //blood group validation
        if ($_POST["blood-grp"] == "none") {
            $bloodGroupErr = "Blood group must be selected";
            $isValid = false;
        } else {
            $bloodGroup = test_input($_POST["blood-grp"]);
            $isValid = true;
        }

        //gender valiadion
        if (empty($_POST["gender"])) {
            $genderErr = "Please select your gender";
            $isValid = false;
        } else {
            $gender = test_input($_POST["gender"]);
            $isValid =  true;
        }
    }
    ?>


    <div class="split-screen">
        <div class="left">
            <section class="copy">
                <h1>Learn to codeBorom Free</h1>
                <p>Read tutorials, try examples, write programs, and learn to code.</p>
            </section>
        </div>
        <div class="right">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <section class="copy">
                    <h1>Register</h1>
                    <p>Already have an an account?
                        <a href="#">
                            <strong>Log In</strong>
                        </a>
                    </p>
                </section>
                <div class="input-container name">
                    <label for="fname">Full Name</label>
                    <input id="fname" name="fname" type="text" placeholder="Sayed Syfuzzaman">
                    <span class="input-err"><?php echo $nameErr ?></span>
                </div>

                <div class="input-container email">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" placeholder="someone@email.com">
                    <span class="input-err"><?php echo $emailErr ?></span>
                </div>

                <section class="dob">
                    <label>Date of birth</label>
                    <div class="date">
                        <div class="date-container" style="width: calc(100% / 4 - 5px)">
                            <select name="dd" id="dd">
                                <option value="none" selected>Day</option>
                                <option value='01'>01</option>
                                <option value='02'>02</option>
                                <option value='03'>03</option>
                                <option value='04'>04</option>
                                <option value='05'>05</option>
                                <option value='06'>06</option>
                                <option value='07'>07</option>
                                <option value='08'>08</option>
                                <option value='09'>09</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                                <option value='15'>15</option>
                                <option value='16'>16</option>
                                <option value='17'>17</option>
                                <option value='18'>18</option>
                                <option value='19'>19</option>
                                <option value='20'>20</option>
                                <option value='21'>21</option>
                                <option value='22'>22</option>
                                <option value='23'>23</option>
                                <option value='24'>24</option>
                                <option value='25'>25</option>
                                <option value='26'>26</option>
                                <option value='27'>27</option>
                                <option value='28'>28</option>
                                <option value='29'>29</option>
                                <option value='30'>30</option>
                                <option value='31'>31</option>
                            </select>
                        </div>

                        <div class="date-container" style="width: calc(100% / 2.5 - 5px)">
                            <select name="mm" id="mm">
                                <option value="none" selected>Month</option>
                                <option value='01'>January</option>
                                <option value='02'>February</option>
                                <option value='03'>March</option>
                                <option value='04'>April</option>
                                <option value='05'>May</option>
                                <option value='06'>June</option>
                                <option value='07'>July</option>
                                <option value='08'>August</option>
                                <option value='09'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <div class="date-container" style="width: calc(100% / 3.5 - 5px)">
                            <?php
                            // used this to set an option as selected
                            $already_selected_value = 1984;
                            $earliest_year = (int)date('Y') - 100;

                            print '<select name="yyyy" id = "yyyy">';
                            foreach (range($earliest_year, date('Y')) as $x) {
                                print '<option value="' . $x . '"' . '>' . $x . '</option>';
                            }
                            print '<option value="none" selected>Year</option>';
                            print '</select>';
                            ?>



                        </div>
                    </div>
                    <span class="input-err"><?php echo $dobErr ?></span>
                </section>

                <section class="dob">
                    <label>Blood group</label>
                    <div>
                        <select name="blood-grp" id="blood-grp">
                            <option value="none" selected>Select Blood Group</option>
                            <option value="A positive">A+VE</option>
                            <option value="A negative">A-VE</option>
                            <option value="B positive">B+VE</option>
                            <option value="B negative">B-VE</option>
                            <option value="O positive">O+VE</option>
                            <option value="O negative">O-VE</option>
                            <option value="AB positive">AB+VE</option>
                            <option value="AB negative">AB-VE</option>
                        </select>
                    </div>
                    <span class="input-err"><?php echo $bloodGroupErr ?></span>
                </section>
                <section class="radio-checkbox">
                    <div class="gender">
                        <label>Gender</label>
                        <label for="male" class="radio-container">
                            <input type="radio" id="male" name="gender" value="male">
                            <span class="radiomark"></span>
                            Male
                        </label>
                        <label for="female" class="radio-container">
                            <input type="radio" id="female" name="gender" value="female">
                            <span class="radiomark"></span>
                            Female
                        </label>
                        <label for="other" class="radio-container">
                            <input type="radio" id="other" name="gender" value="other">
                            <span class="radiomark"></span>
                            Prefer not to say
                        </label>
                        <span class="input-err"><?php echo  $genderErr ?></span>
                    </div>

                    <div class="degree">
                        <label>Degree</label>
                        <label for="ssc" class="checkbox-container">
                            <input type="checkbox" id="ssc" name="degree1" value="ssc">
                            <span class="checkmark"></span>
                            SSC
                        </label>
                        <label for="hsc" class="checkbox-container">
                            <input type="checkbox" id="hsc" name="degree2" value="hsc">
                            <span class="checkmark"></span>
                            HSC
                        </label>
                        <label for="bsc" class="checkbox-container">
                            <input type="checkbox" id="bsc" name="degree3" value="bsc">
                            <span class="checkmark"></span>
                            BSc
                        </label>
                        <label for="msc" class="checkbox-container">
                            <input type="checkbox" id="msc" name="degree4" value="msc">
                            <span class="checkmark"></span>
                            Msc
                        </label>
                        <span class="input-err"><?php echo $degreeErr ?></span>
                    </div>
                </section>




                <button class="register-btn" type="submit">Register</button>

                <section class="copy legal">
                    <p><span>By continuing, you agree to accept our <br> <a href="#">Privacy Policy</a></span></p>
                </section>
            </form>
        </div>
    </div>
</body>

</html>