<?php
session_start();

if(!isset($_SESSION['user_session']))
{
 header("Location: index.html#SignIn");
}

include_once 'PHP/ProfileDBLogin.php';


$conn = new PDO("sqlsrv:server = tcp:vrprofile.database.windows.net,1433; Database = VRProfile", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT * FROM profiledb WHERE uUsrID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['user_session']));
$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
      <div data-role="content">
          <div data-role="content" style="height:100%; margin-bottom:10px;">
                  <center>
                    <br><strong>Hello, <?php echo $row['uFName']; ?></strong><hr>
                    <img height="100" width="100" src="ProfilePhoto.png">
                    <div data-role="collapsible" data-theme="b">
                      <h3>Favorites</h3>
                      <p>Favorite House 1<br>
                         Favorite House 2<br>
                         Favorite House 3<br>
                         Favorite House 4<br>
                      </p>
                    </div>
                    <table>
                      <tbody>
                      <tr>
                        <th scope="row"><a href="">Notifications</a></th>
                      </tr>
                      <tr>
                        <th scope="row"><a href="">Settings</a></th>
                      </tr>
                      <tr>
                        <th scope="row"><a href="">Feedback</a></th>
                      </tr>
                      <tr>
                        <th scope="row"><a href="">Terms & Privacy Policy</a></th>
                      </tr>
                      </tbody>
                    </table>
                  </center>
          </div><!--End Main Content-->
      </div>
</body>
</html>
