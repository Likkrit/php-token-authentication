<?php 

/**
 * A simple JSON token signature and authentication in PHP
 *
 * ```
 *
 * @see https://github.com/Likkrit
 **/


function createToken($id){
	$obj = array(
		'id' => $id,
		'exp' => time(),
	);
	$token = json_encode($obj);
	$token64 = base64_encode($token);
	$token64 = str_replace("=","",$token64);
	$signature = signature($token64);
	return $token64.'.'.$signature;
}


function signature($token64){
	$key = 'key';
	$token64key = $token64 . $key;
	$signature = substr(md5($token64key),-16);
	return $signature;
}



function verifyToken($token64key){
	$token64key = explode(".",$token64key);
	if(!is_array($token64key) || count($token64key) != 2 ){
		return 'error token';
	}
	$signature = $token64key[1];
	$token64 = $token64key[0];
	$token = base64_decode($token64);

	$obj = json_decode($token);
	if(!$obj || !isset($obj->exp)){
		return 'error token';
	}
	$time = $obj->exp + 12;

	if($time<time()){
		return 'expired token';
	}

	if(signature($token64) == $signature){
		return $obj;
	}
	else{
		return 'error signature';
	}

}



echo createToken(1);

echo verifyToken('eyJpZCI6IjFkZGRkZGRkc2Rmc2Rmc2Rmc2RmIiwiZXhwIjoxNDgwMzEzMDEyfQ.05925220c3273e09');
?>