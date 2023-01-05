<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=require_once("connection.php");
    $username=$_POST["userName"];
    $password=$_POST["userPassword"];
    //檢查帳號是否重複
    $check="SELECT * FROM users WHERE userName='".$username."'";
    $result=$conn->query($check);
    $row_cnt=$result->num_rows;
    if($row_cnt==0){
        $sql="INSERT INTO users (username, password) VALUES ('".$username."','".$password."')";
        if($conn->query($sql)){
            $conn->close();
            echo "<script>alert('註冊成功! 返回登入頁'); location.href='../index.php'; </script>";
            exit;
        }else{
            $conn->close();
            echo "Error creating table: " . $conn->error;
        }
    }
    else{
        $conn->close();
        require_once "config.php";
        $_SESSION["username"] = $username;
        echo "<script>alert('註冊失敗! 該帳號已有人使用'); location.href='../register.php'; </script>";
        exit;
    }
}
else{
    header("location:../index.php");
    exit;
}
?>
