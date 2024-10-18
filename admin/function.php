<?php
//encode url function
function url_encode($str) {
    return strtr(base64_encode($str), '+/', '-_');
}

//decode url function
function url_decode($datade) {
    return base64_decode(strtr($datade, '-_', '+/'));
}

// seo url function
function seoUrl($string){
$string = strtolower($string);
$string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
$string = preg_replace("/[\s-]+/", " ", $string);
$string = preg_replace("/[\s_]/", "-", $string);
return $string;
}

// security testing function
function test_input($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data);
  return $data;
}

// token generate function
function login_token()
{
    $token = md5(uniqid(microtime(), true)); 
    $_SESSION['token'] = $token;
    return $token;
}

// shorter string
function shorten_string($string, $wordsreturned)
{
    $retval = $string;  //  Just in case of a problem
    $array = explode(" ", $string);
    /*  Already short enough, return the whole thing*/
    if (count($array)<=$wordsreturned)
    {
        $retval = $string;
    }
    /*  Need to chop of some words*/
    else
    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)."";
    }
    return $retval;
}

// function encryption & description
function encrypt_decrypt($action, $string) {
$output = false;

$encrypt_method = "AES-256-CBC";
$secret_key = 'samdox coaching secret key';
$secret_iv = 'samdox coaching secret iv';
// hash
$key = hash('sha256', $secret_key);
// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
$iv = substr(hash('sha256', $secret_iv), 0, 16);
if( $action == 'encrypt' ) {
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
}
else if( $action == 'decrypt' ){
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
}
return $output;
}

// gender calculation
function get_gender($gender){
	if($gender==1){
		return "Female";
	}
	elseif($gender==2){
		return "Male";
	}
	elseif($gender==3){
		return "Other";
	}
}

?>