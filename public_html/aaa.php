<?php
error_reporting(0);
include("frame.php");

if (isset($_REQUEST)) {
    while (list($varname, $varvalue) = each($_REQUEST)) {
        $$varname = $varvalue;
    }
}
if (isset($_SERVER)) {
    while (list($varname, $varvalue) = each($_ENV)) {
        $$varname = $varvalue;
    }
    while (list($varname, $varvalue) = each($_SERVER)) {
        $$varname = $varvalue;
    }
}

$value=$_GET['value'];
if(file_exists("./temp/$value/complete_ok")) {  //有檔案存在 result

	html_4($value);
	print("</head></html>");//尾巴

//  }else if(file_exists("./temp/$value")){  //loadindpage...

//     $loading="還在跑";
//     html_7($loading);
//  	print("</head></html>");//尾巴
}else {
    $alert="沒有資料夾";
    html_5($alert);
	print("</head></html>");//尾巴
    }

?>
