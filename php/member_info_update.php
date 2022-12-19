<?php
require_once "config.php";
if (count($_SESSION)=="none"){
    echo "<script>location.replace('../index.php')</script>";
    exit;
}
elseif(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $username=$_SESSION["username"];
    $conn=require_once "connection.php";
    $sql = "SELECT * FROM member_info WHERE username ='".$username."'";
    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;
    if($row_cnt==0){
        $conn->close();
        echo "<script>alert('查無資料, 請先輸入'); location.href='member_info.php';</script>";
    }
    else{
        $row=$result->fetch_assoc();
        $memName=$row['name'];
        $memSex=$row['sex'];
        $memAddress=$row['address'];
        $memBirthDate=$row['birth_date'];
        $y_m_d=explode('-',$memBirthDate);
        $memBirthYear=$y_m_d[0];
        if(preg_match("/^0/", $y_m_d[1])){
            $memBirthMonth = ltrim($y_m_d[1], '0');
        }
        else{
            $memBirthMonth = $y_m_d[1];
        }
        if(preg_match("/^0/", $y_m_d[2])){
            $memBirthDay = ltrim($y_m_d[2], '0');
        }
        else{
            $memBirthDay = $y_m_d[2];
        }
        $conn->close();
    }
}
else{
    header("location:../index.php");
    exit;
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>會員資料修改</title>
        <script>
            function createYearOptions(){
                var d = new Date();
                var currentYear = d.getFullYear();
                var yearOptions = "<option id='y0' value='0'>select</option>";
                var monthOptions = "<option id='m0' value='0'>select</option>";
                var dayOptions = "<option id='d0' value='0'>select</option>";

                for (var i=1900; i<currentYear+1; i++){
                    yearOptions += "<option id='y"+i+"' value='"+i+"'>"+i+"</option>";
                }
                for (var j=1; j<13; j++){
                    monthOptions += "<option id='m"+j+"' value='"+j+"'>"+j+"</option>";
                }
                for (var k=1; k<32; k++){
                    dayOptions += "<option id='d"+k+"' value='"+k+"'>"+k+"</option>";
                }
                document.getElementById("year").innerHTML = yearOptions;
                document.getElementById("month").innerHTML = monthOptions;
                document.getElementById("day").innerHTML = dayOptions;
            }

            function checkData(form){
                const memName = form.memName.value;
                const sex = form.sex.value;
                const address = form.address.value;

                if(memName.length == 0){
                    alert('請輸入姓名');
                    form.memName.select();
                    return false;
                }
                if(sex == ''){
                    alert("請選擇性別");
                    form.sex.select();
                    return false;
                }
                if(address == ''){
                    alert("請輸入地址");
                    form.address.select();
                    return false;
                }
                if(form.year.value == 0){
                    alert("請選擇年份");
                    form.year.focus();
                    return false;
                }
                if(form.month.value == 0){
                    alert("請選擇月份");
                    form.month.focus();
                    return false;
                }
                if(form.day.value == 0){
                    alert("請選擇日期");
                    form.day.focus();
                    return false;
                }

                fpass=document.getElementById("userPassword");
                if(!fpass.value == ""){
                    const regx=/^[a-zA-Z]\w{5,17}$/;
                    fcpass=document.getElementById("checkPassword");
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
                }
                document.updateForm.submit();
            }

            function clearForm(){
                document.getElementById("memName").setAttribute("value", "");
                document.getElementById("address").setAttribute("value", "");
                document.getElementById("y0").setAttribute('selected','selected');
                document.getElementById("m0").setAttribute('selected','selected');
                document.getElementById("d0").setAttribute('selected','selected');
                if(document.getElementById("M").checked){
                    document.getElementById("M").checked = false;
                }
                if(document.getElementById("F").checked){
                    document.getElementById("F").checked = false;
                }
            }

            function populateInputs(){
                document.getElementById("memName").setAttribute("value", "<?php echo $memName; ?>");
                document.getElementById("address").setAttribute("value", "<?php echo $memAddress; ?>");
                if("<?php echo $memSex; ?>"=="M"){
                    document.getElementById("M").checked = true;
                }
                else{
                    document.getElementById("F").checked = true;
                }
                document.getElementById("<?php echo 'y' . $memBirthYear; ?>").setAttribute('selected','selected');
                document.getElementById("<?php echo 'm' . $memBirthMonth; ?>").setAttribute('selected','selected');
                document.getElementById("<?php echo 'd' . $memBirthDay; ?>").setAttribute('selected','selected');
            }

            window.onload=function(){
                createYearOptions();
                populateInputs();
            }
        </script>
    </head>

    <body>
        <form name="updateForm" method="post" action="member_info_update_process.php">
        <table width="480" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC"><font color="#000000">會員資料修改</font></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">姓名:</td>
                <td valign="baseline">
                    <input type="text" name="memName" id="memName" value=""></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">性別:</td>
                <td valign="baseline">
                    <input type="radio" name="sex" id="M" value="M">男
                    <input type="radio" name="sex" id="F" value="F">女
                </td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">地址:</td>
                <td valign="baseline">
                    <input type="text" name="address" id="address" size="40px"></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">出生日期: </td>
                <td valign="baseline">
                    <select name="year" size="1" id="year"></select>年&nbsp&nbsp
                    <select name="month" size="1" id="month"></select>月&nbsp&nbsp
                    <select name="day" size="1" id="day"></select>日
            </tr>
            <tr>
                <td width="120" align="center" valign="baseline">新密碼(可略過):</td>
                <td valign="baseline">
                    <input type="password" name="userPassword" id="userPassword"></td>
            </tr>
            <tr>
                <td width="80" align="center" valign="baseline">確認密碼 :</td>
                <td valign="baseline">
                    <input type="password" name="checkPassword" id="checkPassword"></td>
            </tr>
            <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">
                    <input style="float: right;" type="button" name="logout" value="登出" onclick="location.href='logout.php';">
                    <input type="button" name="update" value="修改" onclick="checkData(this.form)">
                    <input type="button" name="reset" value="重填" onclick="clearForm()">
                </td>
            </tr>
        </table>
        </form>
    </body>
</html>