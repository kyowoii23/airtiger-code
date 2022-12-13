<?php
session_start();
include "../inc/imp_db.inc";
if(@!$_POST['id'] && @!$_POST['pw']){
    include './screen_login.php';
} else if (@!$_SESSION['id'] && @!$_SESSION['pw']){
    $ok_handler = mysqli_connect($db_host, $db_account, $db_password, $db_dbname);
    if(!$ok_handler){
        echo "오류낫다 고쳐라";
    }
    $checkAdminQuery = "SELECT * FROM `tiger_login` where `id` = '{$_POST['id']}'";

    $db_content = mysqli_query($ok_handler,$checkAdminQuery);
    if(!$db_content) {
        echo "<script>alert('No query'); location.href='./screen_login.php'</script>";
    }
    

    $test_info = mysqli_fetch_assoc($db_content);
    if($test_info['pwd'] == md5($_POST['pw']) && $test_info['id'] == $_POST['id']) {
            
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['pw'] = md5($_POST['pw']);
            echo "<script>location.reload();location.href='./main.php'</script>";
        } else {
            mysqli_free_result($db_content);
            mysqli_close($ok_handler);
            
            echo "<script>location.href=\"./screen_login.php?login=no\";</script>";
            //echo "<script>document.getElementById(\"login_error_kkw\").style.visibility = \"visible\";</script>";
    }

}
?>