<?php
require("HouseDBlogin.php");
try {
    $conn = new PDO("sqlsrv:server = tcp:vrrealty.database.windows.net,1433; Database = VRHouse", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
//Sets variable to query for
$filter = $_GET['ListingNo'];

echo"<table border='1'>";
echo"<tr>";
           echo"<td>";
               echo"Name";
           echo"</td>";
           echo"<td>";
               echo"Address";
           echo"</td>";
           echo"<td>";
               echo"Type";
           echo"</td>";
       echo"</tr>";
      foreach($conn->query("SELECT * FROM markers WHERE type LIKE '".$filter."'") as $row)
       {
           echo"<tr>";
               echo"<td>";
                   echo '' . $row['name'] . '';
               echo"</td>";
               echo"<td>";
                   echo '' . $row['address'] . '';
               echo"</td>";
               echo"<td>";
                   echo '' . $row['type'] . '';
               echo"</td>";
           echo"</tr>";
         }
echo"</table>";
?>
