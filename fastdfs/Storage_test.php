<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo 'in testing';

include('./Storage.php');
$obj = new Storage();

/*
 $remote_filename = "M00/28/E3/U6Q-CkrMFUgAAAAAAAAIEBucRWc5452.h";
 $file_id = $group_name . FDFS_FILE_ID_SEPERATOR . $remote_filename;
 */
 
// 上传示例 
// $re = $obj->uploadFile('/data/webapp/test/test.txt','html');
 // echo "<hr/>upload return: ";
// var_dump($re);

// 上传附属文件/缩略图 $localFile,$master_file_name,$prefix[,$file_ext]
// $re = $obj->uploadSlave('/data/webapp/test/test.txt','M00/00/00/wKgB3VVJ_IiAC13HAAAASYsfSVw06.html','_100x100','html');
// echo "<hr/>uploadSlave return: ";
// var_dump($re);
 
//删除示例 附属文件缩略图删除: "M00/00/00/wKgB3VVJ_IiAC13HAAAASYsfSVw06_100x100.html"
$re = $obj->deleteFile('M00/00/00/wKgB3VVJ_IiAC13HAAAASYsfSVw06.html');
echo "<hr/>delete return: ";
var_dump($re);
