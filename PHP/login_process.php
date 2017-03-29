<?php
	session_start();
	require_once 'ProfileDBLogin.php';

	if(isset($_POST['btn-login']))
	{
		//$user_name = $_POST['user_name'];
		$uEmail = trim($_POST['uEmail']);
		$uPWord = trim($_POST['HashPass']);

		$HashPass = md5($uPWord);

		try
		{
			$conn = new PDO("sqlsrv:server = tcp:vrprofile.database.windows.net,1433; Database = VRProfile", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->prepare("SELECT * FROM profiledb WHERE uEmail=:email");
			$stmt->execute(array(":email"=>$uEmail));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();

			if($row['uPWord']==$HashPass){

				echo "ok"; // log in
				$_SESSION['user_session'] = $row['uUsrID'];
			}
			else{

				echo "E-mail or password does not exist."; // wrong details
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
