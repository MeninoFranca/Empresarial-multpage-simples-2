<?php

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // trata as entradas do formulário.
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r", "\n"), array(" ", " "), $name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $num = trim($_POST["phone"]);
    $comment = trim($_POST["comment"]);

    if (empty($name) || empty($comment) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Por favor, preencha o formulário e tente novamente.";
        exit;
    }
    $recipient = "comercial.vrpsul@gmail.com";

    $sub = "Contato pelo formulário do site: $name";

    $email_content = "Nome: $name\n";
    $email_content .= "E-mail: $email\n\n";
    $email_content .= "Telefone: $num\n\n";
    $email_content .= "Mensagem:\n$comment\n";
}

?>