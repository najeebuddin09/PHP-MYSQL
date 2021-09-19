<?php
    session_start();
    if (isset($_GET['signout']) && $_GET['signout']){
        session_destroy();
        header("location: registration_login_page.php");
    }
    if (!isset($_SESSION['name'])){
        header("location: registration_login_page.php");
    }
    //echo filter_has_var(INPUT_POST, 'send_msg_submit')."<br>";
    if (filter_has_var(INPUT_POST, 'send_msg_submit')){
        $to_email = $_POST['to_email'];
        $msg = $_POST['msg_input'];

        $con = mysqli_connect('localhost','root','') or die("could not connect to the server");
        mysqli_select_db($con,'connections') or die("could not select the db");

        $query = "SELECT email FROM `users`";
        $result = mysqli_query($con,$query);

        function check_if_email_exist_in_db($result, $email_to_match){
            while($db_email = mysqli_fetch_array($result)){
                //echo $db_email[0]."<br>";
                if ($db_email[0] === $email_to_match){
                    //echo "email found<br>";
                    return true;
                }
            }
            return false;
        }

        if (check_if_email_exist_in_db($result, $to_email)){              
            $query = "INSERT INTO `msgs` (`to_email`, `from_email`, `msg`) VALUES ('$to_email', '".$_SESSION['email']."', '$msg');";
            $result = mysqli_query($con,$query);

            if ($result){
                header("location: user_page.php?msg_sent_success=true&send_msg=true");
            }
        } else {
            header("location: user_page.php?email_not_match=true&send_msg=true");
        }

        /*
        if ($query){
            echo "Query is successful<br>";
        }
        else{
            echo "Query failed<br>";
        }
        */
    }
    //echo (isset($_GET['inbox']) && $_GET['inbox'])."<br>";
    if (isset($_GET['inbox']) && $_GET['inbox']){
        $con = mysqli_connect('localhost','root','') or die("could not connect to the server");
        mysqli_select_db($con,'connections') or die("could not select the db");

        $query = "SELECT from_email,msg FROM `msgs` WHERE to_email = '".$_SESSION['email']."'";
        //echo $query."<br>";
        $data = mysqli_query($con,$query);

        /*
        if ($data){
            echo "Query is successful<br>";
        }
        else{
            echo "Query failed<br>";
        }
        */
    }
    if (isset($_GET['outbox']) && $_GET['outbox']){
        $con = mysqli_connect('localhost','root','') or die("could not connect to the server");
        mysqli_select_db($con,'connections') or die("could not select the db");

        $query = "SELECT to_email,msg FROM `msgs` WHERE from_email = '".$_SESSION['email']."'";
        //echo $query."<br>";
        $data = mysqli_query($con,$query);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connections</title>
    <link href="registration_login_styles.css" type="text/css" rel="stylesheet">
    <link href="user_page_styles.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="main">
        <div id="header">
            <h1>CONNECTIONS</h1>
            <h4>Get Connections</h4>
        </div>
        <div class="body">
            <div class="left_navigation_panel">
                <a href="user_page.php?user_info=true">Profile</a><br>
                <a href="user_page.php?send_msg=true">Send Message</a><br>
                <a href="user_page.php?inbox=true">Inbox</a><br>
                <a href="user_page.php?outbox=true">Outbox</a><br>
                <a href="user_page.php?signout=true">SignOut</a><br>
            </div>
            <div class="side_panel scrollable">
                <?php
                    if (isset($_GET['user_info']) && $_GET['user_info']){
                        echo "
                        <div class=\"info_panel\">
                            <div class=\"pic\">
                                <img src=\"".$_SESSION['pic']."\">
                            </div>
                            <div class=\"information\">
                                <p>".$_SESSION['name']."</p>
                                <p>".$_SESSION['email']."</p>
                            </div>
                        </div>
                        ";
                    } else if (isset($_GET['send_msg']) && $_GET['send_msg']){
                        echo "
                            <div class=\"send_msg_container\">
                                <div class=\"send_msg_title\">
                                    Send Message
                                </div>
                                <div class=\"send_msg_body\">
                                    <form method=\"post\" action=\"".$_SERVER['PHP_SELF']."?send_msg=true\" name=\"send_msg_form\">
                                        <span class=\"label_receiver_email\">Receiver Email:</span>
                                        <input type=\"email\" name=\"to_email\" id=\"to_email\"><br>
                                        <span class=\"label_msg\">Your Message:</span>
                                        <textarea maxlength=250 name=\"msg_input\" class=\"msg_input\" id=\"msg_input\"></textarea><br>
                                        <input type=\"submit\" name=\"send_msg_submit\" value=\"Send Message\" class=\"btn\">
                                    </form>
                                </div>
                            </div>
                        ";
                        if (isset($_GET['email_not_match']) && $_GET['email_not_match']){
                            echo "
                                <div class=\"send_msg_warning\">
                                    <h4>This Email address does not exist</h4>
                                </div>
                            ";
                        } else if (isset($_GET['msg_sent_success']) && $_GET['msg_sent_success']){
                            echo "
                                <div class=\"send_msg_warning\">
                                    <h4>Message has been sent successfuly</h4>
                                </div>
                            ";
                        }
                    } else if (isset($_GET['inbox']) && $_GET['inbox']){
                        if (empty($row=mysqli_fetch_array($data))){
                            echo "
                                <div class=\"send_msg_container inbox_container\">
                                    <div class=\"send_msg_title email_title\">
                                        No message in Inbox!
                                    </div>
                                </div>
                            ";
                        } else {
                            do {
                                echo "
                                    <div class=\"send_msg_container inbox_container\">
                                        <div class=\"send_msg_title email_title\">
                                            From: ".$row[0]."
                                        </div>
                                        <div class=\"inbox_body\">
                                            ".$row[1]."
                                        </div>
                                    </div>
                                ";
                            } while ($row=mysqli_fetch_array($data));
                        }
                    } else if (isset($_GET['outbox']) && $_GET['outbox']){
                        if (empty($row=mysqli_fetch_array($data))){
                            echo "
                                <div class=\"send_msg_container inbox_container\">
                                    <div class=\"send_msg_title email_title\">
                                        No message in Outbox!
                                    </div>
                                </div>
                            ";
                        } else {
                        do {
                                echo "
                                    <div class=\"send_msg_container inbox_container\">
                                        <div class=\"send_msg_title email_title\">
                                            To: ".$row[0]."
                                        </div>
                                        <div class=\"inbox_body\">
                                            ".$row[1]."
                                        </div>
                                    </div>
                                ";
                            } while ($row=mysqli_fetch_array($data));
                        }
                    }
                ?>
            </div>
        </div>
        <div id="footer">
            &copy; All rights reserved
        </div>
    </div>
    
</body>
</html>