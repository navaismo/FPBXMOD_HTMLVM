#!/usr/bin/php -q
<?php

date_default_timezone_set('America/Mexico_City');

//************** obtenemos el stdin del asterisk *************************************/
$in = fopen('php://stdin', 'r');
while(!feof($in)){
    $text = $text . fgets($in, 4096);
}

//************* guardamos la salida a un archivo temporal ****************************/
$time=time();
$fp = fopen("/etc/asterisk/data_" .$time .".txt", "w");
fwrite($fp, $text);
fclose($fp);

//************ Pbtenemos las Lineas que contienen los datos del Buzon
$path = "/etc/asterisk/data_" .$time. ".txt";
$handle = fopen($path, "r");
$lines = file($path);  

//*********** las lineas que usaremos son:
$linenum = 2; //email
$linenum2 = 17; // variables vm
$linenum3 = 19; // numero de mensaje

$toemail=get_between($lines[$linenum],"<",">"); //********* el email
$msg=str_replace('"',"",$lines[$linenum3]);     //********* Quitamos las comillas
$msg2=get_between($msg,"=",".wav");		//********* el numero de mensaje
$args=$lines[$linenum2];			//********* argumentos del vm(nombre, buzon, CID etc)	

/*********** Separamos los Valores de Nombre, buzon, Fecha, CID y Duracion *************************/
$vmargs=explode("|",$args);
$name=$vmargs[0];
$mailbox=$vmargs[1];
$dur=$vmargs[2];
$cid=$vmargs[3];
$date=$vmargs[4];

/********** Construimos las Variables a usar para enviar el email **********************************/

$mail_lib_path  = "/etc/asterisk/PHPMailer/";	
$from		= 
//f1
"youremail@yourdomain.com";
//f2

$fromName	= 
//n1
"Your company name";
//n2

$host           = 
//h1
"Your host";
//h2

$username       = 
//u1
"youremail@yourdomain.com";
//u2

$password       = 
//p1
"yourpassword";
//p2

$port 		= 
//o1
"yourport";
//o2

$subject 	= 
//s1
"yoursubject";
//s2


/***************** Este es el Body a editar las URLS **************************/
//$body = file_get_contents("/etc/asterisk/vm_html_body");
$body =
//b1
"<table border='0'>
   <tbody>
<tr><td bgcolor='#084B8A' colspan='2' width='40'></td></tr>
<tr><td><img src='http://goo.gl/WRq7N'><b>Dear: ${name}</b></td></tr>
<tr><td>Just to let you now that you have a new Voicemail from the number <b>${cid}</b> received on ${date}.</td></tr>
<tr><td>To check your Voicemail from your phone just dial <b>*98</b> or go to the next <a href='serveraddr/recordings'>URL</a></td></tr>
<tr><td></td></tr>
<tr><td bgcolor='#084B8A' colspan='2' width='2'></td></tr>
</tbody></table>
<div align='center'>
Voicemail System</div>";
//b2



/*************** Asignamos las varibales al constructor email ******************/
require($mail_lib_path . "class.phpmailer.php");  
$mail = new PHPMailer(true);
$mail -> IsHTML (true);
$mail->IsSMTP();
//$mail->SMTPDebug  = 1;                     // Habilita información SMTP (opcional para pruebas)
                                             // 1 = errores y mensajes
                                             // 2 = solo mensajes
$mail->SMTPAuth   = true;                  // Habilita la autenticación SMTP
$mail->Subject  = $subject;
$mail->Body	= $body;
$mail->AddAddress($toemail,$name);
$mail->From     = $from;  
$mail->FromName = $fromName;
$mail->Host     = $host;  
$mail->Mailer   = "smtp";   
$mail->SMTPAuth = true;
$mail->Username = $username;
$mail->Password = $password;
$mail->Port 	= $port; 
$mail->AddAttachment("/var/spool/asterisk/voicemail/default/".${mailbox}."/INBOX/".${msg2}.".wav");



/************* enviar email ******************************/
if($mail->Send())
{
	echo "\r\nSent Ok! \r\n";
} else {
	echo "\r\nSend Failed... \r\n";
	echo $mail->ErrorInfo;
}

/**************** eliminamos el archivo temporal ******************/
unlink("/etc/asterisk/data_" .$time .".txt");

/****************** funcion para obtener una cadena entre dos palabras ****************/
function get_between ($text, $s1, $s2) {
$mid_url = "";
$pos_s = strpos($text,$s1);
$pos_e = strpos($text,$s2);
for ( $i=$pos_s+strlen($s1) ; (( $i<($pos_e)) && $i < strlen($text)) ; $i++ ) {
$mid_url .= $text[$i];
}
return $mid_url;
}

?>
