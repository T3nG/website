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
    $memIdNumber=$_POST['id_number'];
    $sql = "SELECT * FROM member_info WHERE id_number ='".$memIdNumber."'";
    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    $row=$result->fetch_assoc();
    if($row_cnt==1){
        $conn->close();
        alert_msg("已有資料, 無須再填寫");
        exit;
    }
    $memBirthDate=$memBirthYear . '-' . $memBirthMonth . '-' . $memBirthDay;
    $cmd = sprintf(
        "INSERT INTO member_info (username, name, sex, address, birth_date, id_number) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
        $username, $memName, $memSex, $memAddress, $memBirthDate, $memIdNumber
    );
    if($conn->query($cmd)){
        $conn->close();
        alert_msg("輸入成功! 返回會員資料頁");
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
else{
    header("location:../index.php");
    exit;
}

function alert_msg($message) {
    echo "<script>alert('$message'); location.href='welcome.php'; </script>";
    return false;
}
?>