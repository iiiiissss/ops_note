<?php
class Storage {
	// 远程配置
	private $_remote_url  = '';
	// 链接重试次数
	private $_try_connect_max = 3;

	// 临时目录
	private $_tmp_dir = '/tmp';
	
	// 默认组名 一般可以不写
	private $_group_name;
	
	
	// 文件服务器集群地址
	private $_clusters = array('http://192.168.1.221/api_fastdfs.php');
	// 当前能用的文件服务器地址
	private $_server_addr = 'http://192.168.1.221/api_fastdfs.php';
	
	// 远程COOKIE文件
	private $_remote_cookie;
	
	public function __construct($group_name = ''){
		if(!empty($group_name)) $this->_group_name = $group_name;
		//TODO:做成集群，　可以多个地址上传
		// $vars = get_class_vars(__CLASS__);
		// if( isset($GLOBALS['storage']) ){
			// $params = $GLOBALS['storage'];
			// foreach($vars as $var => $v){
				// if(key_exists($var, $params)){
					// $this->{$var} = $params[$var];
				// }
			// }
		// }else{
			// Global $storage;
			// foreach($vars as $var){
				// if(key_exists('_'.$var, $storage))$this->{'_'.$var} = $storage['_'.$var];
			// }
		// }
		// if(!STORAGE_TEST)$this->_connect();
	}

	/** 
	 * 上传本地文件
	 * @param  $localFile 本地文件路径
	 * @param  $file_ext   文件扩展名
	 */
	public function uploadFile($localFile, $file_ext = '') {
		$i = 0;
		do{
			$re = $this->_post($this->_server_addr, array(
				'op'=>'upload', 
				'filedata' => '@'.$localFile,
				'file_ext'  => $file_ext,
				'group_name' => $this->_group_name,
			));
			$i++;
		}while( empty($re) && $i < $this->_try_connect_max );
		return $re;
	}
	/**
	 *上传附属文件/缩略图
	 *
	 * @param master_file_name 
	 * @param prefix  60*60
	 */
	public function uploadSlave($localFile,$master_file_name,$prefix,$file_ext = '') {
		$i = 0;
		do{
			$re = $this->_post($this->_server_addr, array(
				'op'=>'upload_slave', 
				'filedata' => '@'.$localFile,
				'master_file_name' => $master_file_name,
				'prefix'  => $prefix,
				'file_ext'  => $file_ext,
				'group_name' => $this->_group_name,
			));
			$i++;
		}while( empty($re) && $i < $this->_try_connect_max );
		return $re;
	}

	
	/**
	 * 删除文件
	 * @param  $file_id 文件id
	 */
	public function deleteFile($file_id) {
		$re = $this->_post($this->_server_addr, array(
			'op'=>'delete', 
			'file_id' => $file_id,
			'group_name' => $this->_group_name,
		));
		return $re;
	}
	
	/**
	 * 下载文件
	 * @param  $file_id 文件id
	 */
	public function downloadFile($file_id,$file_offset=0,$download_bytes=0) {
		$re = $this->_post($this->_server_addr, array(
			'op'=>'download', 
			'file_id' => $file_id,
			'file_offset' => $file_offset,
			'download_bytes' => $download_bytes,
			'group_name' => $this->_group_name,
		));
		return $re;
	}
	

	private function _connect(){
		foreach($this->_clusters as $clusters){
			$i = 0;
			do{
				if ($this->_ping($clusters)){
					$this->_server_addr = $clusters; 
					return;
				}
				$i++;
			}while($i < $this->try_connect_max);
		}
		throw new Exception('无法链接文件服务器集群');
	}
	private function _ping($url){
		return $this->_post($url, array(
			'op' => 'ping',
		));
	}

	private function _post($url, $post = array()){
		$c = curl_init(); 
		curl_setopt($c, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($c, CURLOPT_URL, $url); 
		curl_setopt($c, CURLOPT_POST, true); 
		curl_setopt($c, CURLOPT_TIMEOUT, 900); 
		//$this->_remote_cookie or curl_setopt($c, CURLOPT_COOKIEFILE, $this->_remote_cookie); 
		//$this->_remote_cookie or curl_setopt($c, CURLOPT_COOKIEJAR, $this->_remote_cookie);
		curl_setopt($c, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);		
		curl_setopt($c, CURLOPT_POSTFIELDS, $post); 
		$data = curl_exec($c); 
		curl_close($c); 
		return $data;
	}
}
