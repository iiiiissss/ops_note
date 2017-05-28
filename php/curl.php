curl.php

function docurl($url,$post_data=array(),$post=true){
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$res = curl_exec($ch);
		curl_close($ch);
		return json_decode($res,true);
	}



public function file_get_my_contents($url){
		$opts = array(   
			'http'=>array(   
				'method'=>"GET",   
				'timeout'=>2,//单位秒  
			)   
		);
		return file_get_contents($url, false, stream_context_create($opts));
	}



function Post($url, $post = null){   
    $context = array ();   
    if (is_array ( $post )) {   
        ksort ( $post );   
        $context ['http'] = array (   
            'timeout' => 60,    
            'method' => 'POST',    
            'content' => http_build_query( $post, '', '&' )   
         );   

    }   
    return file_get_contents ( $url, false, stream_context_create ( $context ) );   
}   
