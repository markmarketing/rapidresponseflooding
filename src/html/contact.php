<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include dirname(__FILE__) . "/sys/Config.php";
include dirname(__FILE__) . "/sys/Database.php";
include dirname(__FILE__) . "/sys/DataRepo.php";
include dirname(__FILE__) . "/sys/CSRF.php";

$errors = [];
$name = $email = $phone = $message = "";

$post['name']       = trim($_POST['name']);
$post['email']      = trim($_POST['email']);
$post['phone']      = trim($_POST['telephone']);
$post['message']    = trim($_POST['message']);

$remote_address     = $_SERVER['REMOTE_ADDR'];
#$datetime           = date("Y-m-d H:i:s");

if (isset($_POST) && !empty($_POST) && isset($_POST['contact_form'])) {

    if (isset($post['name']) && !empty($post['name'])) {
        $name = sprintf('%s', $post['name']);
    } else {
        $errors['name'] = "name is missing";
    }

    if (isset($post['email']) && !empty($post['email'])) {

        $email = sprintf('%s', $post['email']);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
            $errors['email'] = "email address is invalid";
        }
        
    } else {
        $errors['email'] = "email address is missing";
    }

    if (isset($post['phone']) && !empty($post['phone'])) {
        $phone = sprintf('%s', $post['phone']);
    } else {
        $errors['phone'] = "phone number is missing";
    }

    if (isset($post['message']) && !empty($post['message'])) {
        $message = sprintf('%s', $post['message']);
    } else {
        $errors['message'] = "message body is missing";
    }
}

if (!empty($errors)) {
    echo json_encode("we have some errors");
    header('Location: /contact.html?success=0');
    exit();
}

$headers = "From: " . $email . "\r\n" .
    "Reply-To: " . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$db = Database::getInstance(Config::getInfo());
$sql = sprintf(
    "INSERT INTO contactus SET 
            `name` = '%s',
            `email` = '%s',
            `telephone` = '%s',
            `message` = %s,
            `remote_ip` = '%s'",
    $name,
    $email,
    $phone,
    $db->quote($message),
    $remote_address
);


$result = DataRepo::query($sql, $db, 'INSERT');

# mail("freddie.apakali@gmail.com", "Message from Contact Us form - RapidResponse User- " . $name, $message, $headers);
header('Location: /contact.html?success=1');
exit();


// print_r(apache_getenv('ENV'));
// print_r(getenv('ENV'));
// print_r(GetEnv('ENV'));
// #echo phpinfo();
// print_r("<pre>");
// #echo print_r($_SERVER, true);
// echo print_r($_SERVER, true);
// exit;
