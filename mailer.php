<?php


require("assets/sendgrid-php/sendgrid-php.php");

$name = $_POST['name']; 
$email = $_POST['email']; 


if (!filter_var( $email, FILTER_VALIDATE_EMAIL) ) {
   die("Please go back and enter a valid email address");
}


$message = $html_message = "";
foreach( $_POST as $key => $value ) {

    $$key = filter_var( $_POST[$key], FILTER_SANITIZE_STRING);

    $message .= ucwords(str_ireplace('_', ' ', $key)) . "\n" . $value . "\n\n";

    $html_message .= "<p><b><u>" . ucwords(str_ireplace('_', ' ', $key)) . "</u></b>" . "<br />" . $value . "</p>";

}

// this has to come after the loop
$subject = "(" . date('mdY') . ") Startup-Fresno.com " . $_POST['subject'];
 


$sendgrid = new SendGrid('iolguin', '*2tDw5NZOYm7zL!$');
 

$email = new SendGrid\Email();
$email->addTo('iolguin@shift3tech.com')
        //->addTo('helle@cvbi.org')
        ///->addTo('timothys@csufresno.edu')
        //->addTo('jeffmacon@csufresno.edu')
        //->addTo('acano@csufresno.edu')
        //->addTo('jsoberal@bitwiseindustries.com')
        ->setFrom('iolguin@bitwiseindustries.com')
        ->setSubject( $subject )
        ->setText( $message )
        ->setHtml( $html_message );
 
 
$sendgrid->send($email);
 

header('Location: thanks.html'); 
exit();

 
?>