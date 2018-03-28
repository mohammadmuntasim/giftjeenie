
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controller_curl extends CI_Controller {

public function __construct() {
parent::__construct();
}
public function index(){

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://giftjeenie.theapptest.xyz/v3/user/login");
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
//curl_setopt($ch, CURLOPT_HEADER  ,1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_POST, true);
$data = array(
         'email' => 'ajitem.s@outlook.com',
        'password' => 'myp@ssw0rd'
   );

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$content = curl_exec($ch);

curl_close($ch);

$response = json_decode( $content );

$token = base64_encode( $response->id . ':' . $response->token );

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://giftjeenie.theapptest.xyz/v3/products/all");
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:11.0) Gecko/20100101 Firefox/11.0');
//curl_setopt($ch, CURLOPT_HEADER  ,1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION  ,1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Basic ' . $token )); 

$content = curl_exec( $ch );

$response = json_decode( $content );

var_dump( $response );
}



}
?>

