<?php


 function descodificar($value){   
    switch ($value) {
			case "01":
				return "Janeiro";
				break;
			case "02":
				return "Fevreiro";
				break;
			case "03":
				return "Março";
				break;
			case "04":
				return "Abril";
				break;
			case "05":
				return "Maio";
				break;
			case "06":
				return "Junho";
				break;
			case "07":
				return "Julho";
				break;
			case "08":
				return "Agosto";
				break;		
			case "09":
				return "Setembro";
				break;
			case "10":
				return "Outubro";
				break;
			case "11":
				return "Novembro";
				break;
			case "12":
				return "Dezembro";
				break; }
				
	//return "Setembro";		
	}
$x=5;
    $x=date("m");
    
    $current_month=descodificar($x);
    $current_year=date("Y");
    /*
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }*/
    /*
    // validation expected data exists
    if(!isset($_POST['field795']) ||
        !isset($_POST['field798']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['field799']) ||
        !isset($_POST['field800'])) {
        died('Pedimos desculpa, mas parece haver problemas com a sua submissão.');      
    }*/
     
    $first_name = $_POST['field795']; // required
    $assunto = $_POST['field798']; // required
    $email_from = $_POST['Email']; // required
    $telephone = $_POST['field796']; // not required
			
    $comments = $_POST['field799']; // required
    $data=$_POST['field800'];
     
//Ligação à base de dados
include("db_connect/ligacao.php");


//Selecionar todos os formatos do grupo - Preencher menus laterais
$sql ="INSERT INTO contacto (data, nome, email, telefone, assunto, mensagem, mes, ano) values ('$data', '$first_name', '$email_from','$telephone', '$assunto', '$comments', '$current_month', ' $current_year' )";
$resultado = mysql_query($sql, $ligacao); 
/*echo "<script language=javascript>alert('Please enter a valid username.')</script>";
echo "<script type=\"text/javascript\">alert('Your password has been updated!')</script>";
echo "<script type='text/javascript'>alert('Your password has been updated!')</script>";*/
?>


<?php
echo("<script type='text/javascript'> alert('Obrigado pelo o seu contacto, entraremos em contacto consigo brevemnete.'
); location.href='nm_contactos.php';</script>");

//echo("<script type='text/javascript'>location.href='nm_contactos.php';</script>");
//header("Location: nm_contactos.php");


?>


