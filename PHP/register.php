<?php

	require_once 'ProfileDBLogin.php';

	if($_POST)
	{
		$uFName = $_POST['uFName'];
		$uLName = $_POST['uLName'];
		$uEmail = $_POST['uEmail'];
		$uPWord = $_POST['HashPass'];
		$uYrJn =date('Y-m-d H:i:s');

		$HashPass = md5($uPWord);

		try
		{

			$conn = new PDO("sqlsrv:server = tcp:vrprofile.database.windows.net,1433; Database = VRProfile", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			$stmt = $conn->prepare("SELECT * FROM profiledb WHERE uEmail=:email");
			$stmt->execute(array(":email"=>$uEmail));
			$count = $stmt->rowCount();

			if($count==0){

			$stmt = $conn->prepare("INSERT INTO profiledb(uFName,uLName,uEmail,uPWord,uYrJn) VALUES(:uFName, :uLName, :email, :pass, :jdate)");
			$stmt->bindParam(":uFName",$uFName);
			$stmt->bindParam(":uLName",$uLName);
			$stmt->bindParam(":email",$uEmail);
			$stmt->bindParam(":pass",$HashPass);
			$stmt->bindParam(":jdate",$uYrJn);

				if($stmt->execute())
				{
					echo "registered";
				}
				else
				{
					echo "Query could not execute!";
				}

			}
			else{

				echo "1"; //  not available
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>
