<?php
require_once "php/config.php";

// Check if the user is already logged in, if yes then redirect to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: php/welcome.php");
    exit;
}
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    unset($_SESSION['username']);
}else{
    $username="";
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>會員登入</title>
        <script>
            function validate() {
                const reg=/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/;
                const regx=/^[a-zA-Z]\w{5,17}$/;
                fname=document.getElementById("userName");
                fpass=document.getElementById("userPassword");
                if(!reg.test(fname.value)){
                    alert("帳號格式錯誤, 英文+數字, 長度介於5~16之間");
                    fname.select();
                    return false;
                }
                if(!regx.test(fpass.value)){
                    alert("密碼格式錯誤, 英文+數字, 長度介於6~18之間");
                    fpass.select();
                    return false;
                }
                document.loginForm.submit();
            }
      </script>
    </head>
    <body>
        <form method="post" action="php/login.php" name="loginForm" id="loginForm">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#000000">會員登入</font></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">帳號 :</td>
                <td valign="baseline">
                    <input type="text" name="userName" id="userName" value="<?php echo $username; ?>"></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">密碼 :</td>
                <td valign="baseline">
                    <input type="password" name="userPassword" id="userPassword" <?php if(!empty($username)){ ?> autofocus <?php } ?>></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="hidden" name="action" value="store">
                    <input type="button" name="login" value="登入" onclick="validate()">
                    <input type="button" name="register" onclick="location.href='register.php';" value="註冊"></td>
            </tr>
        </table>
        </form>
    </body>
</html>