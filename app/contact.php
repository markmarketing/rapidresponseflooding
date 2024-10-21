<?php 

$errors = [];

if (isset($_POST) && !empty($_POST) && isset($_POST['contact_form'])) {
        
    if (!empty($_POST['name'])) {
        $name = sprintf('%s', $_POST['name']);
    }
    else {
        $errors['name'] = "name is missing";
    }


    if (!empty($_POST['email'])) {
        $email = sprintf('%s', $_POST['email']);
    }
    else {
        $errors['email'] = "email address is missing";
    }

    if (!empty($_POST['telephone'])) {
        $phone = sprintf('%s', $_POST['telephone']);
    }
    else {
        $errors['telephone'] = "phone number is missing";
    }

    if (!empty($_POST['message'])) {
        $message = sprintf('%s', $_POST['message']);
    }
    else {
        $errors['message'] = "message body is missing";
    }

}

if (!empty($errors)) {
    echo json_encode("we have some errors");
    header('Location: /contact.html'); exit();
}

$headers = "From: ". $email . "\r\n" .
    "Reply-To: ". $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail("rapidresponsehd@gmail.com", "Message from Contact Us form - RapidResponse User- " . $name, $message, $headers);
header('Location: /contact.html?success=0'); exit();
