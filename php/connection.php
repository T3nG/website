<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/*define() 函數定義一個常量。
在設定以後，常量的值無法更改
常量名不需要開頭的美元符號 ($)
作用域不影響對常量的訪問
常量值只能是字符串或數字*/
define('DB_HOST',
    'cosmowhale.asuscomm.com');
define('DB_USERNAME',
    'wpwb');
define('DB_PASSWORD',
    'ppap1217');
define('DB_DATABASE',
    'website');

/* Attempt to connect to MySQL database */
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if($conn->connect_error){
    die('Error connected');
}
else{
    return $conn;
}
?>