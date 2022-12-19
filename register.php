<?php
require_once "php/config.php";
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
    <title>會員註冊</title>
    <script>
        function validate() {
            const reg=/^[a-zA-Z][a-zA-Z0-9_]{4,15}$/;
            const regx=/^[a-zA-Z]\w{5,17}$/;
            fname=document.getElementById("userName");
            fpass=document.getElementById("userPassword");
            fcpass=document.getElementById("checkPassword");
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
            if(fpass.value != fcpass.value){
                alert("請確認密碼是否輸入正確");
                fpass.select();
                return false;
            }
            document.registerForm.submit();
        }
    </script>

    </head>
    <body>
        <form name="registerForm" method="post" action="php/register_process.php">
        <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#000000">會員註冊</font></td>
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
                <td width="80" align="center" valign="baseline">確認密碼 :</td>
                <td valign="baseline">
                    <input type="password" name="checkPassword" id="checkPassword"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input type="button" value="註冊" name="button" onclick="validate()">
                    <input type="reset" value="重設"></td>
            </tr>
        </table>
        </form>
    </body>
</html>