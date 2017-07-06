<?php
if(isset($_POST['Email'])) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "joaovpsilva@hotmail.com";
    $email_subject = "Email nº";
     
     
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
    
    // validation expected data exists
    if(!isset($_POST['field795']) ||
        !isset($_POST['field798']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['field799']) ||
        !isset($_POST['field800'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
     
    $first_name = $_POST['field795']; // required
    $assunto = $_POST['field798']; // required
    $email_from = $_POST['Email']; // required
    /*if(!isset($_POST['field796'])
		$telephone = $_POST['field796']; // not required
	else
		$telephone = "Não disponibilizado";*/
		
		
    $comments = $_POST['field799']; // required
    $data=$_POST['field800'];
     
    $error_message = "";
  /*  $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }*/
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Data/Hora: ".clean_string($data)."\n";
    $email_message .= "Nome: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    //$email_message .= "Telefone: ".clean_string($telephone)."\n";
    $email_message .= "Assunto: ".clean_string($assunto)."\n";
    $email_message .= "Mensagem: ".clean_string($comments)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
mail($email_to, $email_subject, $email_message, $headers); 


?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
}
?>
