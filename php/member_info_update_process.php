<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    require_once "config.php";
    $username=$_SESSION["username"];
    $conn=require_once "connection.php";
    $memName=$_POST['memName'];
    $memSex=$_POST['sex'];
    $memAddress=$_POST['address'];
    $memBirthYear=$_POST['year'];
    $memBirthMonth=$_POST['month'];
    $memBirthDay=$_POST['day'];
    $password=$_POST["userPassword"];
    $sql = "SELECT * FROM member_info WHERE username ='".$username."'";
    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    $row=$result->fetch_assoc();
    $memBirthDate=$memBirthYear . '-' . $memBirthMonth . '-' . $memBirthDay;
    $cmd_one = sprintf(
        "UPDATE member_info SET name='%s', sex='%s', address='%s', birth_date='%s' WHERE username='%s'",
        $memName, $memSex, $memAddress, $memBirthDate, $username
    );
    $cmd_two = sprintf(
        "UPDATE users SET password='%s' WHERE username='%s'", $password, $username
    );
    if(!$conn->query($cmd_one)){
        $conn->close();
        echo "Error creating table: " . $conn->error;
        echo "連接資料庫失敗.. 5 秒後自動轉回登入頁";
        header("Refresh:5; url=../index.php");
        exit;
    }
    if(!$password == ''){
        if($conn->query($cmd_two)){
            $conn->close();
            echo "<script>alert('修改成功! 返回會員資料頁'); location.href='welcome.php'; </script>";
            exit;
        }
        else{
            $conn->close();
            echo "Error creating table: " . $conn->error;
            echo "連接資料庫失敗.. 5 秒後自動轉回登入頁";
            header("Refresh:5; url=../index.php");
            exit;
        }
    }
    $conn->close();
    echo "<script>alert('修改成功! 返回會員資料頁'); location.href='welcome.php'; </script>";
    exit;
}
else{
    header("location:../index.php");
    exit;
}
?>