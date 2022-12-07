<?php
if (isset($_POST['Name'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "adler.ukishima@gmail.com";
    $email_subject = "RSVP";

    function problem($error)
    {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br><br>";
        echo $error . "<br><br>";
        echo "Please go back and fix these errors.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['attend'])
    ) {
        problem('We are sorry, but there appears to be a problem with the form you submitted.');
    }

    $name = $_POST['Name']; // required
    $attend = $_POST['attend']; // required
	$guest = $_POST['Guest'];
	$song = $_POST['Song'];
	$message = $_POST['Message'];

    $error_message = "";

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'The Name you entered does not appear to be valid.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'Too many characters in message. <br>';
    }


    $email_message = "Form details below.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Name: " . clean_string($name) . "\n";
    $email_message .= "Attending: " . clean_string($attend) . "\n";
	$email_message .= "Guest: " . clean_string($guest) . "\n";
	$email_message .= "Song: " . clean_string($song) . "\n";
    $email_message .= "Message: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $Name . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Thank you for contacting us. We will be in touch with you very soon.

<?php
}
?>