<?php

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . './error_log.txt');
error_reporting(E_ALL);

session_start();
require('libs/class.email_sending.php');
include 'DB_connection.php';

$emails = explode(',', $_POST['email']);
$email_subject = $_POST['subject'];
$email_body = $_POST['emailBody'];
$email_cc = array();

$email_sender = new EmailSender();

if ($email_sender->sendEmail($emails, $email_subject, $email_body, $email_cc)) {
    $_SESSION['header_message_success'] = 'Email successfully sent...';
    unset($_SESSION['header_message_error']);
} else {
    $_SESSION['header_message_error'] = 'Error occur while sending email, please try again later';
    unset($_SESSION['header_message_success']);
}
header("location:admin_view.php?page=" . $_SESSION['page']);