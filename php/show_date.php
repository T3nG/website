<?php
date_default_timezone_set('Asia/Taipei');
header('content-type:text/xml');
$xml = "<document>";
$xml .= "<time>";  //.= 前後字相加  <document><time>
$xml .= date('Y/m/d H:i:s');  //取得目前的伺服器時間
$xml .= "</time>";
$xml .= "</document>";
echo $xml;
?>