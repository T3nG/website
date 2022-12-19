function createYearOptions(){
    var d = new Date();
    var currentYear = d.getFullYear();
    var yearOptions = "<option value='0'>select</option>";
    var monthOptions = "<option value='0'>select</option>";
    var dayOptions = "<option value='0'>select</option>";

    for (var i=1900; i<currentYear+1; i++){
        yearOptions += "<option value='"+i+"'>"+i+"</option>";
    }
    for (var j=1; j<13; j++){
        monthOptions += "<option value='"+j+"'>"+j+"</option>";
    }
    for (var k=1; k<32; k++){
        dayOptions += "<option value='"+k+"'>"+k+"</option>";
    }
    document.getElementById("year").innerHTML = yearOptions;
    document.getElementById("month").innerHTML = monthOptions;
    document.getElementById("day").innerHTML = dayOptions;
}

function checkData(form){
    var total = 0;
    const chkid = "0123456789ABCDEFGHJKLMNPQRSTUVXYWZIO";
    const memName = form.memName.value;
    const sex = form.sex.value;
    const address = form.address.value;
    const idNumber = form.id_number.value.toUpperCase();
    const reg = /^[A-Za-z][12]\d{8}$/
    const c1 = chkid.indexOf(idNumber.charAt(0));

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
    if (idNumber == ''){
        alert("請輸入身分證字號");
        form.id_number.select();
        return false;
    }
    // 檢查格式
    if (!reg.test(idNumber)){
    	alert("身分證字號格式錯誤");
        form.id_number.select();
    	return false;
    }
    // 計算權重
    for(var i=1;i<=8;i++){
       	total += chkid.indexOf(idNumber.charAt(i))*(9-i);
    }
    total = total + chkid.indexOf(idNumber.charAt(9))*1 + parseInt(c1/10)*1 + (c1%10)*9;

    if(total%10 != 0){
        alert("所輸入的身分證字號不合理");
        form.id_number.select();
      	return false;
    }
    document.inputForm.submit();
}

function populateInputs(){
    document.getElementById("memName").setAttribute("value", "<?php echo $memName; ?>");
    document.getElementById("address").setAttribute("value", "<?php echo $memAddress; ?>");
    document.getElementById("id_number").setAttribute('value', "<?php echo $memIdNumber; ?>");
    if("<?php echo $memSex; ?>"=="M"){
        document.getElementById("M").checked = true;
    }
    else{
        document.getElementById("F").checked = true;
    }
    var select_y = document.getElementById('year');
    var option_y;
    for (var i=0; i<select_y.options.length; i++) {
        option_y = select_y.options[i];
        if (option_y.value == "<?php echo $memBirthYear; ?>") {
            option_y.selected = true;
            return;
        }
    }
    var select_m = document.getElementById('month');
    var option_m;
    for (var i=0; i<select_m.options.length; i++) {
        option_m = select_m.options[i];
        if (option_m.value == "<?php echo $memBirthMonth; ?>") {
            option_m.selected = true;
            return;
        }
    }
    var select_d = document.getElementById('day');
    var option_d;
    for (var i=0; i<select_d.options.length; i++) {
        option_d = select_d.options[i];
        if (option_d.value == "<?php echo $memBirthDay; ?>") {
            option_d.selected = true;
            return;
        }
    }
}

window.onload=function(){
    createYearOptions();
}