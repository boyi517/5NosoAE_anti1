<?php
// upload.php

//@session_start();
//$session_path = "./temp/" . session_id();
$session_path = "./temp/" . $_POST['folderID'];
mkdir($session_path, 0777);


if (empty($_FILES['file'])) {
    // No files found for upload.
    echo json_encode(['error'=>'未選擇檔案']);
    return; 
}
else{
    $images = $_FILES['file']; // 獲取上傳的文件
    $filenames = $images['name']; // 文件名
    $filetypes = $images['type']; // 文件類型
    $filesizes = $images['size']; // 文件大小
    $filetmps = $images['tmp_name']; // 文件臨時路徑
}
$success = null; // 上傳成功與否的flag
for($i=0; $i < count($filenames); $i++){ // 接收上傳的文件
    $ext = explode('.', basename($filenames)); //将文件名按 “.” 分割成数组
//    $target = "./temp/upload" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext); //上傳到server的路徑（文件名用uniqid和md5生成 不重覆唯一）

//    $target = "./temp/" . session_id() . "." . array_pop($ext); //上傳到server的路徑（文件名用uniqid和md5生成 不重覆唯一）

//    $target = "./temp/" . session_id() . "/" . $filenames; //上傳到server的路徑（文件名用uniqid和md5生成 不重覆唯一）
    $target = "./temp/" . $_POST['folderID'] . "/contigFile.fa"; //上傳到server的路徑（文件名用uniqid和md5生成 不重覆唯一）

//    $target = "./temp/" . md5(uniqid()) . "." . array_pop($ext); //上傳到server的路徑（文件名用uniqid和md5生成 不重覆唯一）

//    $target = "./temp/456.fa";
    if(move_uploaded_file($filetmps, $target)) { //tmp_name 為上傳檔案的臨時位置，將其移動到需要上傳的路径
        $success = true;
	exec("echo $filenames > $session_path/contigFile.list");
    } else {
        $success = false;
        break;
    }
}
if ($success === true) {
    $output = ['success'=>'上傳成功']; // 成功的處理
} 
elseif ($success === false) { 
    $output = ['error'=>'上傳失敗']; // 失敗的處理
} 
else {
    $output = ['error'=>'未知操作']; //處理未知情況
}
echo json_encode($output); // 返回json

