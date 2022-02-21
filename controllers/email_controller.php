<?php

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername(EMAIL)
    ->setPassword(PASSWORD);

$mailer = new Swift_Mailer($transport);

function send_verification($user_email, $token) {
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verify email</title>
    </head>
    <body>
        <div>
            <p>
                Thank you for signing up on our website.
                Please click the link below to verify your account.
            </p>
            <a href="127.0.0.1/BT/index.php?token=' . $token . '">
                Click here
            </a>
        </div>
    </body>
    </html>';

    // create message
    $message = (new Swift_Message('Verify your email address'))
        ->setFrom(EMAIL)
        ->setTo($user_email)
        ->setBody($body, 'text/html');

    // send message
    $result = $mailer->send($message);
}

function send_link($user_email, $token) {
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verify email</title>
    </head>
    <body>
        <div>
            <p>
                Please click the link below to reset your password.
            </p>
            <a href="127.0.0.1/BT/index.php?password_token=' . $token . '">
                Reset your password
            </a>
        </div>
    </body>
    </html>';

    // create message
    $message = (new Swift_Message('Reset your password'))
        ->setFrom(EMAIL)
        ->setTo($user_email)
        ->setBody($body, 'text/html');

    // send message
    $result = $mailer->send($message);
}

function send_adlink($user_email, $token) {
    global $mailer;

    $body = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Verify email</title>
    </head>
    <body>
        <div>
            <p>
                Please click the link below to reset your password.
            </p>
            <a href="127.0.0.1/BT/admin_home.php?password_token=' . $token . '">
                Reset your password
            </a>
        </div>
    </body>
    </html>';

    // create message
    $message = (new Swift_Message('Reset your password'))
        ->setFrom(EMAIL)
        ->setTo($user_email)
        ->setBody($body, 'text/html');

    // send message
    $result = $mailer->send($message);
}