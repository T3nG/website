<?php
require_once "config.php";
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username=$_SESSION["username"];
    // 印出$_SESSION的內容
    // var_dump(implode(",", $_SESSION));
}
else{
    header("location:../index.php");
    exit;
}
?>
<html>
    <style>
    .button{
        width: 80px;
    }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>會員設定</title>
        <script type="text/javascript" src="../js/loadXMLDoc.js"></script>
    </head>
    <body>
        <h1 style="text-align:center; font-family:arial;" id="h1">Hello, <?php echo $username; ?></h1>
        <h2 style="text-align:center; font-family:arial;" id="h2"></h2>
        <table align="center">
            <tr>
                <td colspan="2">
                    <input class="button" type="button" name="insertData" id="insertData" value="輸入資料" onclick="location.href='member_info.php';">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="button" type="button" name="updateData" id="updateData" value="修改資料" onclick="location.href='member_info_update.php';">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input class="button" type="button" name="logout" id="logout" value="登出" onclick="location.href='logout.php';">
                </td>
            </tr>
       </table>
   </body>
</html>