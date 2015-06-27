<?
function sendMail($toArray, $subject, $message) { 

// $toArray format --> array("Name1" => "address1", "Name2" => "address2", ...) 

ini_set(sendmail_from, "enquiry@tropicanacorp.com.my"); 

$connect = fsockopen (ini_get("SMTP"), ini_get("smtp_port"), $errno, $errstr, 30) or die("Could not talk to the sendmail server!"); 

$rcv = fgets($connect, 1024); 

fputs($connect, "HELO {$_SERVER['SERVER_NAME']}\r\n"); 

$rcv = fgets($connect, 1024); 

while (list($toKey, $toValue) = each($toArray)) { 

fputs($connect, "MAIL FROM:enquiry@tropicanacorp.com.my\r\n"); 

$rcv = fgets($connect, 1024); 

fputs($connect, "RCPT TO:$toValue\r\n"); 

$rcv = fgets($connect, 1024); 

fputs($connect, "DATA\r\n"); 

$rcv = fgets($connect, 1024); 



fputs($connect, "Subject: $subject\r\n"); 

fputs($connect, "From: Tropicana Corporation Berhad <enquiry@tropicanacorp.com.my>\r\n"); 

fputs($connect, "To: $toKey <$toValue>\r\n"); 

fputs($connect, "X-Sender: <enquiry@tropicanacorp.com.my>\r\n"); 

fputs($connect, "Return-Path: <enquiry@tropicanacorp.com.my>\r\n"); 

fputs($connect, "Errors-To: <enquiry@tropicanacorp.com.my>\r\n"); 

fputs($connect, "X-Mailer: PHP\r\n"); 

fputs($connect, "X-Priority: 3\r\n"); 

fputs($connect, "Content-Type: text/plain; charset=iso-8859-1\r\n"); 

fputs($connect, "\r\n"); 

fputs($connect, stripslashes($message)." \r\n"); 



fputs($connect, ".\r\n"); 

$rcv = fgets($connect, 1024); 

fputs($connect, "RSET\r\n"); 

$rcv = fgets($connect, 1024); 

} 



fputs ($connect, "QUIT\r\n"); 

$rcv = fgets ($connect, 1024); 

fclose($connect); 

ini_restore(sendmail_from); 

} 
?> 