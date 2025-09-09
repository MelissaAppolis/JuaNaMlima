<?php
// if(isset($_POST['submit'])){
    header('Access-Control-Allow-Origin: *');
    if(isset($_POST['name'])) {
        $visitor_name = $_POST['name'];
        $retArr["visitor name"] = $visitor_name; 
    } else {
        $retArr["status"] = "Error"; 
	    $retArr["message"]= "Email failed, please provide name.";
	    echo json_encode($retArr);
	    exit;
    }
    if(isset($_POST['email'])) {
        $from = $_POST['email']; // this is the sender's Email address
        $retArr["from"] = $from; 
    } else {
        $retArr["status"] = "Error"; 
	    $retArr["message"]= "Email failed, please provide your email.";
	    echo json_encode($retArr);
	    exit;
    }
    
    if(isset($_POST['cellNo'])) {
        $cellNo = $_POST['cellNo']; // this is the sender's cell number
        $retArr["cellNo"] = $cellNo; 
    } else {
        $retArr["status"] = "Error"; 
	    $retArr["message"]= "Contact No. failed, please provide your contact number.";
	    echo json_encode($retArr);
	    exit;
    }

    if(isset($_POST['message'])) {
       $message = $visitor_name . " with email address: " . $from . " and contact no.: " . $cellNo . " wrote the following:" . "\n\n" . $_POST['message'];
        $retArr["message"] = $message; 
    } else {
        $retArr["status"] = "Error"; 
	    $retArr["message"]= "Email failed, please provide your message.";
	    echo json_encode($retArr);
	    exit;
    }
    
    $to = "info@juanamlima.co.za"; // this is your Email address
    $subject = "Message from: " . " $visitor_name ";
    // $subject2 = "Copy of your form submission";

    
    // $message2 = "Here is a copy of your message " . $visitor_name . "\n\n" . $_POST['message'];

    // $headers = "From:" . $from;
    // $headers2 = "From:" . $to;

    $success = mail($to,$subject,$message);

    if (!$success) {
	    $retArr["status"] = "Error";
        $retArr["description"] = error_get_last()['message'] . "from: " . $from . "name: " . $visitor_name . "message: " . $message ."cellNo: " . $cellNo;
        $retArr["message"] = "Failed to send email, please contact via Whatsapp";
        echo json_encode($retArr);
    } else {
        $retArr["status"] = "Success";
        $retArr["message"] = "Email sent, thank you. We will contact you shortly.";
        echo json_encode($retArr);
    }
    // mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

    // echo "Mail Sent. Thank you " . $visitor_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.
// }





    // $name = $_POST['name'];
    // $visitor_email = $_POST['email'];
    // $message = $_POST['message'];

    // $email_from = 'yourname@yourwebsite.com';

    // $email_subject = "New Form submission";

    // //info@juanamlima.co.za

    // $email_body = "You have received a new message from the user $name.\n".
    //                         "Here is the message:\n $message".

    // $to = "melissaappolis@gmail.com";

    // $headers = "From: $email_from \r\n";
    
    // $headers .= "Reply-To: $visitor_email \r\n";

    // function IsInjected($str)
    // {
    //     $injections = array('(\n+)',
    //         '(\r+)',
    //         '(\t+)',
    //         '(%0A+)',
    //         '(%0D+)',
    //         '(%08+)',
    //         '(%09+)'
    //         );
                
    //     $inject = join('|', $injections);
    //     $inject = "/$inject/i";
        
    //     if(preg_match($inject,$str))
    //     {
    //     return true;
    //     }
    //     else
    //     {
    //     return false;
    //     }
    // }

    // if(IsInjected($visitor_email))
    // {
    //     echo "Bad email value!";
    //     exit;
    // }
    
    // mail($to,$email_subject,$email_body,$headers);



?>