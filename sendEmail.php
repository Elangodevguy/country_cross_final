<?php
use PHPMailer\PHPMailer\PHPMailer;

// Load Composer's autoloader
require 'vendor/autoload.php';
// require_once "constants.php";
$status = " ";
$statusMessage = " ";
if (isset($_POST['submit'])) {
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $content = "
                First Name : $first_name,
                Last Name : $last_name
                email : $email
                phone : $phone
                message : $message";

    /**
     * This example shows settings to use when sending via Google's Gmail servers.
     * This uses traditional id & password authentication - look at the gmail_xoauth.phps
     * example to see how to use XOAUTH2.
     * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
     */
//Import PHPMailer classes into the global namespace
    // use PHPMailer\PHPMailer\PHPMailer;
    // require '../vendor/autoload.php';
    //Create a new PHPMailer instance
    $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
    $mail->isSMTP();
//Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
//Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
// use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6
    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
    $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "thecountrycross@gmail.com";
//Password to use for SMTP authentication
    $mail->Password = "ARAM12345";
//Set who the message is to be sent from
    $mail->setFrom('thecountrycross@gmail.com', 'Elangovan Palanisamy');
//Set an alternative reply-to address
    // $mail->addReplyTo('replyto@example.com', 'First Last');
    //Set who the message is to be sent to
    $mail->addAddress('info@countrycross.in', $first_name);
//Set the subject line
    $mail->Subject = 'Country cross mail from your website';
    $mail->Body = $content;
//Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    // $mail->msgHTML(file_get_contents('contents.html'), __DIR__);
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ),
    );
//Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png');
    //send the message, check for errors
    if (!$mail->send()) {
        // echo "Mailer Error: " . $mail->ErrorInfo;
        $status = 'danger';
        $statusMessage = "Sorry try again $mail->ErrorInfo";

    } else {
        // echo "Message sent!";
        $status = 'success';
        $statusMessage = "Your Message sent successfully";
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container text-center mt-5">
    <h1 class="display-4 text-<?php echo $status; ?>"><?php echo $statusMessage; ?></h1>
    <p class="lead">Please wait for some time to redirect to country cross website</p>
</div>
    <script defer>
function myTimeoutFunction()
{
    window.location.replace('http://localhost/country_cross_final');
}

myTimeoutFunction();
setInterval(myTimeoutFunction, 5000);
    </script>
</body>
</html>
