<?php
require_once "config.php";
if (count($_SESSION)=="none"){
    echo "<script>location.replace('../index.php')</script>";
    exit;
}
elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username=$_SESSION["username"];
}
else{
    header("location:../index.php");
    exit;
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>會員資料輸入</title>
        <script type="text/javascript" src="../js/member_info.js">
        </script>
    </head>
    <body>
        <form name="inputForm" method="post" action="member_info_process.php">
        <table width="450" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#000000">會員資料輸入</font></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">姓名:</td>
                <td valign="baseline">
                    <input type="text" name="memName" value=""></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">性別:</td>
                <td valign="baseline">
                    <input type="radio" name="sex" value="M">男
                    <input type="radio" name="sex" value="F">女
                </td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">地址:</td>
                <td valign="baseline">
                    <input type="text" name="address" value="" size="40px"></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">出生日期: </td>
                <td valign="baseline">
                    <select name="year" size="1" id="year"></select>年&nbsp&nbsp
                    <select name="month" size="1" id="month"></select>月&nbsp&nbsp
                    <select name="day" size="1" id="day"></select>日
            </tr>
            <tr>
                <td width="100" align="center" valign="baseline">身分證字號: </td>
                <td valign="baseline">
                    <input type="text" name="id_number" value=""></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input style="float: right;" type="button" name="logout" value="登出" onclick="location.href='logout.php';">
                    <input type="button" value="送出" onclick="checkData(this.form)">
                    <input type="reset" name="reset" value="重填">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html>