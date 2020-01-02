<?php
session_start();
require_once 'class.user.php';
$user = new USER();



// $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt = $user->runQuery("SELECT * FROM tbl_users, tbl_profil WHERE tbl_users.userID=:uid AND tbl_profil.id_user=:uid;");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$id = $_SESSION['userSession'];
$email = $row['userEmail'];
 // Masukkan log logout ke tabel tbl_log
 if($user->log_out($id, $email, $type)) {
  $user->redirect('index.php');
 }

if(!$user->is_logged_in())
{
 $user->redirect('index.php');
}

if($user->is_logged_in()!="")
{
 $user->logout(); 
 $user->redirect('index.php');
}
?>