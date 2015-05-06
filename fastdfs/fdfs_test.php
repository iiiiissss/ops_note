<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
echo "begin \n";
$tracker = fastdfs_tracker_get_connection();
$storage = fastdfs_tracker_query_storage_store();

echo "upload : ";
$file_info = fastdfs_storage_upload_by_filename('/data/webapp/test/test.txt','html');
var_dump($file_info);
echo "end \n";