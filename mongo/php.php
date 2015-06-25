<?php
$m1 = new MongoClient("mongodb://192.168.1.201:7301,192.168.1.202:7301,192.168.1.203:7301",array("replicaSet" => "repset"));
$db = $m1->kootv;
$users = $db->users;
$count = $users->count();
echo $count;


$test = $db->test;
$array = array('column_name'=>'col'.rand(100,999),'column_exp'=>'xiaocai');
$result=$test->insert($array);
$count = $test->count();
echo '|test:' , $count;