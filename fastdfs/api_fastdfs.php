<?php
//error_reporting(0);

//testing
error_reporting(E_ALL);
ini_set("display_errors", 1);
// var_dump($_REQUEST);

$allows = array( // the IPs allow to access the remoteAction
	'127.0.0.1', '192.168.0.*', '192.168.1.*',
);
/*
$_POST['group_name'] $_FILES['filedata'] 
ping()
upload() 
($file, $file_ext_name[, $meta, $this->group_name])
$_FILES['filedata']['tmp_name'],$_POST['fileext'],$_POST['meta'],$_POST['group_name']
//meta: array('width'=>1024, 'height'=>768)

download() 
delete() 
*/
class remoteAction{
	private $tracker = null;
	private $storage = null;

    
    private $groups = array('group1'); // 服务端配置好的组 不存在的组无效
	//变量
    private $group_name = 'group1';
	private $file = '';
	private $file_id = '';
	private $file_ext = '';
	private $meta = array();
	private $file_offset = 0;
	private $download_bytes = 0;
	private $master_file_id = '';
	private $master_file_name = '';
	private $prefix = '';
	
    public function __construct(){
        Global $allows;
        $ip = $_SERVER['REMOTE_ADDR'];
        $passed = 0;
        foreach($allows as $allowip)if(preg_match('/'.str_replace('.','\.',$allowip).'/', $ip))$passed = 1;
        if(!$passed) exit('no allow ip!');
		
        $this->init_var();
    }
	public function init_var(){
		$vars = array('meta','file_id','file_ext','file_offset','master_file_id','master_file_name','prefix','download_bytes');
		//组名要确保可用
		if(isset($_REQUEST['group_name']) && in_array($_REQUEST['group_name'],$this->groups)){
            $this->group_name = $_REQUEST['group_name'];
        }
		if(isset($_FILES['filedata']['tmp_name'])) $this->file = $_FILES['filedata']['tmp_name'];
		// $vars = get_class_vars(__CLASS__);
		foreach($vars as $v){
			if(isset($_POST[$v])) $this->{$v} = $_POST[$v];
		}
		$this->tracker = fastdfs_tracker_get_connection();
		$this->storage = fastdfs_tracker_query_storage_store();
		if(!$this->tracker||!$this->storage){
			echo ("errno1: " . fastdfs_get_last_error_no() . ", error info: " . fastdfs_get_last_error_info());
	        exit("fastdfs init error");
		}
		
	}
    public function ping(){
            return 1;
    }
    public function upload(){
		if($this->group_name){
			$file_info = fastdfs_storage_upload_by_filename($this->file, $this->file_ext, $this->meta, $this->group_name);	
		}else{//todo: 测试空组名+不指定组名的情况
			$file_info = fastdfs_storage_upload_by_filename($this->file, $this->file_ext, $this->meta, null, $this->tracker, $this->storage);
		}
		return $file_info['filename'];
    }
    public function upload_slave(){
		// $file_info = fastdfs_storage_upload_slave_by_filename1($this->file,$this->master_file_id,$this->prefix,$this->file_ext,$this->meta);
		$file_info = fastdfs_storage_upload_slave_by_filename($this->file,$this->group_name,$this->master_file_name,$this->prefix,$this->file_ext,$this->meta);
		return $file_info['filename'];
	}
    public function download(){
        $file_content = fastdfs_storage_download_file_to_buff($this->group_name, $this->file_id, $this->file_offset, $this->download_bytes);
		return $file_content;
    }
    public function delete(){
        return fastdfs_storage_delete_file($this->group_name, $this->file_id);
    }
}
$rq = new remoteAction;
if(isset($_REQUEST['op']) && method_exists($rq, $_REQUEST['op'])){
	$re = $rq->{$_REQUEST['op']}();
	echo $re;
}else{
	exit('no exit op');
}
// echo '<hr/>end return:';
// var_export($re);