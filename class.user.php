<?php

require_once 'dbconfig.php';

class USER
{ 

 private $conn;
 
 public function __construct()
 {
  $database = new Database();
  $db = $database->dbConnection();
  $this->conn = $db;
    }
 
 public function runQuery($sql)
 {
  $stmt = $this->conn->prepare($sql);
  return $stmt;
 }
 
 public function lasdID()
 {
  $stmt = $this->conn->lastInsertId();
  return $stmt;
 }
 
 public function register($uname,$email,$upass,$code,$hp)
 {
  try
  {       
   // $password = md5($upass);
   $password = password_hash($upass, PASSWORD_DEFAULT);
   // $stmt = $this->conn->prepare("INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode) 
   //                                              VALUES(:user_name, :user_mail, :user_pass, :active_code)");
   $stmt = $this->conn->prepare("
    INSERT INTO tbl_users(userName,userEmail,userPass,tokenCode) VALUES(:user_name, :user_mail, :user_pass, :active_code);
    INSERT INTO tbl_profil(hp) VALUES(:user_hp)
    ");
   $stmt->bindparam(":user_name",$uname);
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":user_pass",$password);
   $stmt->bindparam(":active_code",$code);
   $stmt->bindparam(":user_hp",$hp);

   $stmt->execute(); 
   return $stmt;

  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
 
 public function login($email,$upass)
 {
  try
  {
   $stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
   $stmt->execute(array(":email_id"=>$email));
   $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
   
   if($stmt->rowCount() == 1)
   {
    if($userRow['userStatus']=="Y")
    {
      if(password_verify($upass, $userRow['userPass']))
         {
            $_SESSION['userSession'] = $userRow['userID'];
            return true;
         }
         
     // if($userRow['userPass']==md5($upass))
     // {
     //  $_SESSION['userSession'] = $userRow['userID'];
     //  return true;
     // }
     else
     {
      header("Location: index.php?error");
      exit;
     }
    }

    

    else
    {
     header("Location: index.php?inactive");
     exit;
    } 
   }
   else
   {
    header("Location: index.php?error");
    exit;
   }  
  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }



   public function log_in($email, $type)
 {
  try
  {       
    $type = "login";
   $stmt = $this->conn->prepare("INSERT INTO tbl_log(userEmail,type) VALUES(:user_mail, :type_id)");
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":type_id",$type);

   $stmt->execute(); 
   return $stmt;

  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }

 public function log_out($email, $type)
 {
  try
  {  
    $type = "logout";
   $stmt = $this->conn->prepare("INSERT INTO tbl_log(userEmail,type) VALUES(:user_mail, :type_id)");
   $stmt->bindparam(":user_mail",$email);
   $stmt->bindparam(":type_id",$type);

   $stmt->execute(); 
   return $stmt;

  }
  catch(PDOException $ex)
  {
   echo $ex->getMessage();
  }
 }
  
 
 // public function update($hp,$nama_lengkap) {
 //     try {
 //     $stmt = $this->conn->prepare('UPDATE tbl_profil SET hp = ?, nama_lengkap = ? WHERE id_user = ?');
 //     $stmt->execute(array(":hp"=>$hp, ":nama_lengkap"=>$nama_lengkap, "id_user"=>$_SESSION['userSession']);
 //     return true;
 //     } catch(PDOException $e) {
 //         echo '<p class="bg-danger">'.$e->getMessage().'</p>';
 //     }
 //     return false;
 // }
 
 public function is_logged_in()
 {
  if(isset($_SESSION['userSession']))
  {
   return true;
  }
 }
 
 public function redirect($url)
 {
  header("Location: $url");
 }
 
 public function logout()
 {
  session_destroy();
  $_SESSION['userSession'] = false;
 }
 
 function send_mail($email,$message,$subject)
 {      
  require_once('mailer/PHPMailerAutoload.php');
  $mail = new PHPMailer;
  $mail->IsSMTP(); 
  $mail->SMTPDebug  = 0;                     
  $mail->SMTPAuth   = true;                  
  $mail->SMTPSecure = "ssl";                 
  $mail->Host       = "smtp.gmail.com";      
  $mail->Port       = 465;             
  $mail->AddAddress($email);
  $mail->Username="fikriyogi@gmail.com";  
  $mail->Password="@fikriyogi085264972892";            
  $mail->SetFrom('fikriyogi@gmail.com','Si Tendik');
  $mail->AddReplyTo("you@yourdomain.com","Si Tendik");
  $mail->Subject    = $subject;
  $mail->MsgHTML($message);
  $mail->Send();
 } 
}