Setting database pada folder config->database.php:

private $host = "localhost";
private $db_name = "api_db";
private $username = "postgres";
private $password = "";

Setting SMTP pada folder api/sendmail.php: 

$mail->Host       = "ssl://xxxxxx";
$mail->Username   = "xxxxxxx";
$mail->Password   = "xxxxxxx";

rubah xxxx sesuai dengan host yang digunakan


Untuk menggunakan send email harus login terlebih dahulu. sistem menggunakan JWT untuk validasi token. jika tidak sesuai maka akan direject dan tidak bisa mengirim email
    
 