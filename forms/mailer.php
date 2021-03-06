<?php

require_once "PHPMailerAutoload.php";
ini_set('display_errors', '1');
    ini_set('error_reporting', E_ALL);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $collection = trim($_POST["collection"]);
        $delivery = trim($_POST["delivery"]);
        $phone = trim($_POST["phone"]);
        $dimensions =$_POST["dimensions"];
        $Weight = $_POST["Weight"];
        $DeliveryType = $_POST["DeliveryType"];
        // Check that data was sent to the mailer.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            echo(!filter_var($email, FILTER_VALIDATE_EMAIL));
            exit;
        }
        echo '<script>';
        echo 'console.log("No bug yet")';
        echo '</script>';
    $mail = new PHPMailer(true);

    //Enable SMTP debugging.
    $mail->SMTPDebug = 3;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "mail.privateemail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    $mail->Username = "sales@hls247.co.uk";                 
    $mail->Password = "Hardsell145";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "ssl";                           
    //Set TCP port to connect to
    $mail->Port = 465;

    $mail->From = "sales@hls247.co.uk";
    $mail->FromName = "HLS247";

    $mail->addAddress("sales@hls247.co.uk", "HLS247.co.uk");

    $mail->isHTML(true);

    $mail->Subject = "Quote request from: $email";
    $mail->Body .= "Quote Details:<br/>Collection: $collection <br/>Delivery: $delivery <br/>Telephone Number: $phone <br/> Email: $email <br/> Dimensions LxWxHmm: $dimensions <br/> Weight: $Weight <br/> DeliveryType: $DeliveryType";
    $mail->AltBody .= "quote Details:\n\nCollection: $collection\n\nDelivery: $delivery\n\nTelephone Number: $phone\n\nEmail: $email\n\nDimensions LxWxHmm: $dimensions\n\n Weight: $Weight\n\n DeliveryType: $DeliveryType";

    try {
        $mail->send();
        echo '<script>console.log("Message has been sent successfully");</script>';
    } catch (Exception $e) {
        echo '<script>console.log("Mailer Error: "' . $mail->ErrorInfo . ');</script>';
    }
}

?>