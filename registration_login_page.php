
<?php
    if (filter_has_var(INPUT_POST, 'reg_submit')){  //LOGIN
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $filename = $_FILES['pic']['name'];
        $tmpname = $_FILES['pic']['tmp_name'];
        $destination = "images\\\\".$filename;

        if (!(empty($name) || empty($email) || empty($pass) || empty($filename))){

            $con = mysqli_connect('localhost','root','') or die("could not connect to the server");
            mysqli_select_db($con,'connections') or die("could not select the db");

            move_uploaded_file($tmpname, $destination);
            $query = "INSERT INTO `users` (`name`, `email`, `pass`, `pic`) VALUES ('$name', '$email', '$pass', '$destination');";
            $success = mysqli_query($con,$query);

            if ($success){
                header("location: registration_login_page.php?reg_success=true");
            }

        } else if (empty($name)){
            header("location: registration_login_page.php?reg_name_empty=true");
        } else if (empty($email)){
            header("location: registration_login_page.php?reg_email_empty=true");
        } else if (empty($pass)){
            header("location: registration_login_page.php?reg_pass_empty=true");
        } else if (empty($filename)){
            header("location: registration_login_page.php?reg_filename_empty=true");
        }
    }

    if (filter_has_var(INPUT_POST, 'login_submit')){    //REGISTRATION
        $email = $_POST['email'];
        $pass = $_POST['pass'];

        if (!(empty($email) || empty($pass))){
            $con = mysqli_connect('localhost','root','') or die("could not connect to the server");
            mysqli_select_db($con,'connections') or die("could not select the db");

            /*
            if ($con){
                echo "connection is made<br>";
            } else {
                echo "connection failed<br>";
            }
            */

            $query = "SELECT pass FROM `users` WHERE email = '$email'";
            //echo $query."<br>";
            $result = mysqli_query($con,$query);

            $ret_pass = mysqli_fetch_array($result)[0];

            echo empty($ret_pass)."<br>";

            if (empty($ret_pass)){
                header("location: registration_login_page.php?email_incorrect=true");
            } else {
                /*
                if ($result){
                    echo "Query is successful<br>";
                } else {
                    echo "Query failed<br>";
                }
                */

                //echo $ret_pass."<br>";
                //echo $pass."<br>";
                //echo ($ret_pass === $pass)."<br>";

                if ($ret_pass === $pass){
                    session_start();
                    $info = mysqli_query($con,"SELECT name, pic FROM `users` WHERE email = '$email'");
                    /*
                    if ($info){
                        echo "Query2 is successful<br>";
                    }
                    */
                    $ret_info = mysqli_fetch_array($info);
                    //echo $ret_info[1]."<br>";
                    $_SESSION['name'] = $ret_info[0];
                    $_SESSION['pic'] = $ret_info[1];
                    $_SESSION['email'] = $email;
                    header("location: user_page.php?user_info=true");
                } else {
                    header("location: registration_login_page.php?pass_incorrect=true");
                }
            }
        } else if (empty($email)){
            header("location: registration_login_page.php?email_empty=true");
        } else if (empty($pass)){   
            header("location: registration_login_page.php?pass_empty=true");
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Class Task
        </title>
        <link href="registration_login_styles.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div id="main">
            <div id="header">
                <h1>CONNECTIONS</h1>
                <h4>Get Connections</h4>
            </div>
            <div id="body" style="align-items: center;">
                <form name="login" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table align="center" style="width: 500px;">
                        <tr>
                            <th colspan="2" align="left">User Login</th>
                        </tr>
                        <tr>
                            <td>Your Email</td><td><input type="email" name="email"></td>
                        </tr>
                        <tr>
                            <td>Your Password</td><td><input type="password" name="pass"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><input type="submit" name="login_submit" value="Login" class="btn"></td>
                        </tr>
                    </table>
                </form>
                <div class="reg_success" align="center">
                    <?php
                        if (isset($_GET['email_empty']) && $_GET['email_empty']){
                            echo "
                                <h4>Please fill out the Email field</h4>
                            ";
                        } else if (isset($_GET['pass_empty']) && $_GET['pass_empty']) {
                            echo "
                                <h4>Please fill out the Password field</h4>
                            ";
                        } else if (isset($_GET['email_incorrect']) && $_GET['email_incorrect']) {
                            echo "
                                <h4>The Email is incorrect!</h4>
                            ";
                        } else if (isset($_GET['pass_incorrect']) && $_GET['pass_incorrect']) {
                            echo "
                                <h4>The password is incorrect!</h4>
                            ";
                        }
                    ?>
                </div>
                <form name="registration" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table align="center" style="width: 500px;">
                        <tr>
                            <th colspan="2" align="left">User Registration</th>
                        </tr>
                        <tr>
                            <td>Your full name</td><td><input name="name" type="text"></td>
                        </tr>
                        <tr>
                            <td>Your email address</td><td><input name="email" type="email"></td>
                        </tr>
                        <tr>
                            <td>Your Password</td><td><input name="pass" type="password"></td>
                        </tr>
                        <tr>
                            <td>Your picture</td><td><input type="file" name="pic" value="Choose file"></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="right"><input type="submit" name="reg_submit" value="Register" class="btn"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="reg_success" align="center">
                <?php
                    if (isset($_GET['reg_success']) && $_GET['reg_success']) {
                        echo "
                            <h3>Registration successfull</h3>
                            <h3>Please login now!</h3>
                        ";
                    } else if (isset($_GET['reg_name_empty']) && $_GET['reg_name_empty']) {
                        echo "
                            <h4>Please fill the name field</h4>
                        ";
                    } else if (isset($_GET['reg_email_empty']) && $_GET['reg_email_empty']) {
                        echo "
                            <h4>Please fill the Email field</h4>
                        ";                        
                    } else if (isset($_GET['reg_pass_empty']) && $_GET['reg_pass_empty']) {
                        echo "
                            <h4>Please fill the Password field</h4>
                        ";                        
                    } else if (isset($_GET['reg_filename_empty']) && $_GET['reg_filename_empty']) {
                        echo "
                            <h4>Please add a picture</h4>
                        ";                        
                    }
                ?>
            </div>
            <div id="footer">
                &copy; All rights reserved
            </div>
        </div>
    </body>
</html>