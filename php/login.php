<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conn=require_once "connection.php";
    $username=$_POST["userName"];
    $password=$_POST["userPassword"];
    // 增加hash可以提高安全性
    $password_hash=password_hash($password,PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE username ='".$username."'";
    $result = $conn->query($sql);
    $row_cnt=$result->num_rows;
    $row=$result->fetch_assoc();
    if(!$row_cnt==1){
        $conn->close();
        alert_msg("查無此帳號");
        exit;
    }
    require_once "config.php";
    $_SESSION["username"] = $row["username"];
    if($password==$row["password"]){
        $conn->close();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row["id"];
        header("location:welcome.php");
        exit;
    }
    else{
        $conn->close();
        alert_msg("密碼錯誤");
        exit;
    }
}
else{
    header("location: ../index.php");
    exit;
}

function alert_msg($message) {
    // Display the alert box
    echo "<script>alert('$message'); location.href='../index.php';</script>";
    return false;
}
?>
