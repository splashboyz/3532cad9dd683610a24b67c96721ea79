<?php
// required headers
header("Access-Control-Allow-Origin: http://rest-api-code.net/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// required to encode json web token
include_once '../config/core.php';
include_once '../libs/php-jwt-master/src/BeforeValidException.php';
include_once '../libs/php-jwt-master/src/ExpiredException.php';
include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include_once '../config/database.php';
include_once '../api/user.php';

$database = new Database();
$db = $database->getConnection();
 
// instantiate product object
$user = new User($db);


$data = json_decode(file_get_contents("php://input"));
 
// set product property values
$user->email = $data->email;
$user->subject = $data->subject;
$user->content = $data->content;

if(
    !empty($user->email) &&
    !empty($user->subject) &&
    !empty($user->content) &&
    $user->saveEmail()
)

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Host       = "ssl://xxxxxx";
$mail->Username   = "xxxxxxx";
$mail->Password   = "xxxxxxx";


$mail->IsHTML(true);
$mail->AddAddress("$user->email");
$mail->SetFrom("admin");
$mail->Subject = $user->subject;
$content = "<b>$user->content</b>";


$mail->MsgHTML($content); 
if(!$mail->Send()) {
    http_response_code(200);
    echo json_encode(array("message" => "Send Mail Error"));
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Send Mail Succeed"));
}