<?php

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	session_start();
 // validate token
 $token = isset($_SESSION['existing_customer']) ? $_SESSION['existing_customer'] : "";

 if ($token && $_POST['token'] === $token) {

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "root";
$dbName = "denboomband";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $pdo = new PDO($dsn, $dbUser, $dbPassword);
  
  //below need to add , use only any one in below two statement
  
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 

  ////////

} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}


	$name = test_input($_POST['name']);
	$userid = test_input($_POST['userid']);
	$email = test_input($_POST['email']);
	$phone = test_input($_POST['phone']);
	$reasoncontact = test_input($_POST['reasoncontact']);
	$message = test_input($_POST['message']);
	
	$ipaddress = test_input($_SERVER['REMOTE_ADDR']);
	$referer_url = test_input($_SERVER['HTTP_REFERER']);

	$sql = "INSERT INTO existing_customer (name,userid,email,phone,reasoncontact,message,ipaddress,referer_url) VALUES (:name, :userid, :email, :phone , :reasoncontact ,:message , :ipaddress , :referer_url)";
 
	$stmt = $pdo->prepare($sql);
	
	//Bind param required in case dont prevent from above one

	// $stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
    // $stmt->bind_param("sss", $firstname, $lastname, $email);

	//
	$ok = $stmt->execute(['name' => $name, 'userid' => $userid ,'email' => $email ,'phone' => $phone ,'reasoncontact' => $reasoncontact ,'message' => $message ,'ipaddress' => $ipaddress ,'referer_url' => $referer_url ]);
	if ($ok === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $con->error;
	}

	
	header("Location:thank-you-existing.html");
	unset($_SESSION['existing_customer']);
}else {
   
}
session_write_close();

}
?>