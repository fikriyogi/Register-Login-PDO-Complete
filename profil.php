<?php
session_start();
require_once 'class.user.php';
$user_profil = new USER();

if(!$user_profil->is_logged_in())
{
 $user_profil->redirect('index.php');
}

// $stmt = $user_profil->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt = $user_profil->runQuery("
    SELECT * FROM tbl_users, tbl_profil WHERE tbl_users.userID=:uid AND tbl_profil.id_user=:uid;
    -- SELECT * FROM tbl_profil WHERE id_user=:uid;
    -- INSERT INTO tbl_profil(hp) VALUES(:user_hp)
    ");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<a href="home.php">Beranda</a>


<form action="profil.php" method="POST" enctype="multipart/form-data">
<img name="photo" src="user_images/<?php echo $row['photo']; ?>">
<input type="hidden" name="memids" value="<?php echo $_SESSION['userSession'] ?>" />
First Name<br>
<input type="text" name="userName" value="<?php echo $row['userName']; ?>" disabled/><br>
First Name<br>
<input type="hidden" name="userEmail" value="<?php echo $row['userEmail']; ?>" />
<input type="text" name="userEmail" value="<?php echo $row['userEmail']; ?>" disabled/><br>
Last Name<br>
<input type="text" name="nama_lengkap" value="<?php echo $row['nama_lengkap']; ?>" /><br>
Age<br>
<input type="text" name="hp" value="<?php echo $row['hp']; ?>" /><br>
<input type="submit" name="simpan" value="Save" />
</form>


<form action="profil.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="memids" value="<?php echo $_SESSION['userSession'] ?>" />
<input type="hidden" name="userEmail" value="<?php echo $row['userEmail']; ?>" />
Photo
      <input type="file" name="gambar">
<input type="submit" name="update_photo" value="Save" />
</form>

<?php

// Edit Profil Email
if(isset($_POST['simpan']))
{
  $email = $_POST['userEmail'];
  $nama_lengkap = $_POST['nama_lengkap'];
  $hp = $_POST['hp'];
  $id = $_POST['memids'];

 
 $stmt = $user_profil->runQuery("SELECT userID FROM tbl_users WHERE userEmail=:email LIMIT 1");
 $stmt->execute(array(":email"=>$email));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {
  
  $stmt = $user_profil->runQuery("UPDATE tbl_profil SET nama_lengkap=:nama_lengkap, hp=:hp WHERE id_user=:id");
  $stmt->execute(array(":nama_lengkap"=>$nama_lengkap,":hp"=>$hp,"id"=>$id));

  
  $message= '<table width="100%" height="100%" style="min-width:348px" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tbody>
        <tr height="32" style="height:32px">
            <td></td>
        </tr>
        <tr align="center">
            <td>
                <div>
                    <div></div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0" style="padding-bottom:20px;max-width:516px;min-width:220px">
                    <tbody>
                        <tr>
                            <td width="8" style="width:8px"></td>
                            <td>
                                <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" align="center" class="m_-1851363450284722763mdv2rw"><img src="#"
                                        width="74" height="24" aria-hidden="true" style="margin-bottom:16px" alt="Google" class="CToWUd">
                                    <div style="font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                        <div style="font-size:24px">Profil Anda Berhasil di Update&nbsp;ke</div>
                                        <table align="center" style="margin-top:8px">
                                            <tbody>
                                                <tr style="line-height:normal">
                                                    <td align="right" style="padding-right:8px"><img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%" src="https://lh3.googleusercontent.com/a-/AAuE7mBYeN9ZVeEvKTMFGu4z2v7D9a9CasT-E6t2bnVDuvk=s96" alt="" class="CToWUd"></td>
                                                    <td><a style="font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">'. $email.'</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">Akun Coding Cage Anda baru saja mengupdate profil yang baru. Anda mendapatkan email ini untuk memastikan ini memang Anda.
                                        <div style="padding-top:32px;text-align:center"><a href="https://accounts.google.com/AccountChooser?Email=fikriyogi@gmail.com&amp;continue=https://myaccount.google.com/alert/nt/1574903150000?rfn%3D31%26rfnc%3D1%26eid%3D6107012357955221387%26et%3D0%26anexp%3Dhsc-control_b"
                                                style="font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif;line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#4184f3;border-radius:5px;min-width:90px"
                                                target="_blank" data-saferedirecturl="http://localhost/sitendik/index.php">Periksa aktivitas</a></div>
                                    </div>
                                </div>
                                <div style="text-align:left">
                                    <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                        <div>Anda menerima email ini sebagai pemberitahuan tentang perubahan penting pada layanan dan Akun Google Anda.</div>
                                        <div style="direction:ltr">© 2019 Google LLC, <a class="m_-1851363450284722763afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">1600 Amphitheatre Parkway, Mountain View, CA 94043, USA</a></div>
                                    </div>
                                </div>
                            </td>
                            <td width="8" style="width:8px"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr height="32" style="height:32px">
            <td></td>
        </tr>
    </tbody>
</table>';
  $subject = "Update Profil";
  
  $user_profil->send_mail($email,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
      </div>";
 }
 else
 {
  $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong>  this email not found. 
       </div>";
 }
 header("location:profil.php");
} 


// Edit Photo
if(isset($_POST['update_photo']))
{
  $email = $_POST['userEmail'];
  $id = $_POST['memids'];


  $photo = $_FILES['gambar']['name']; 
  $fotobaru = date('dmYHis')."-".$id;
  $folder ="user_images/".$fotobaru; 
  $path = $folder; 
  $target_file=$folder.basename($_FILES["gambar"]["name"]);
  $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
  $allowed=array('jpeg','png' ,'jpg'); 
  $filename=$_FILES['gambar']['name']; 
  $ext=pathinfo($filename, PATHINFO_EXTENSION); 
  if(!in_array($ext,$allowed) ) 
  { 
   echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
  } else {
 
 $stmt = $user_profil->runQuery("SELECT * FROM tbl_profil WHERE id_user=:uid LIMIT 1");
 $stmt->execute(array(":uid"=>$id));
 $row = $stmt->fetch(PDO::FETCH_ASSOC); 
 if($stmt->rowCount() == 1)
 {

  // Paksa Ganti Photo dan Hapus Yang Lama
  is_file("user_images/".$row['photo']); // Jika foto ada
  unlink("user_images/".$row['photo']); // Hapus file foto sebelumnya yang ada di folder images

  move_uploaded_file( $_FILES['gambar'] ['tmp_name'], $path); 

  $stmt = $user_profil->runQuery("UPDATE tbl_profil SET photo=:photo  WHERE id_user=:id");
  $stmt->execute(array(":photo"=>$fotobaru,"id"=>$id));

  
  $message= '<table id="m_4541953067113816025table-parent" style="background-color:#ffffff;border:0 none;border-collapse:collapse" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <td id="m_4541953067113816025td-parent" style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:0" align="center" bgcolor="#ffffff">
                <div id="m_4541953067113816025email" style="background-color:#ffffff;margin:0 auto;padding:20px 10px" bgcolor="#ffffff">
                    <table align="center" style="background-color:#f1f3f4;border:0 none;border-collapse:collapse;margin:0;max-width:600px;padding:0" bgcolor="#f1f3f4" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:0">
                                    <table style="border:0 none;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td class="m_4541953067113816025header-content" style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:28px 0" align="center" bgcolor="#ffffff" valign="top" width="100%">
                                                    <table style="border:0 none;border-collapse:collapse" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:0" align="center" valign="top" width="100%"><img title="Google Optimize" alt="Google Optimize" src="http://localhost/sitendik/'.$path.'"
                                                                        style="border:0 none;display:inline-block;vertical-align:middle;height:auto;max-height:auto;max-width:26px" border="0" width="26" height="auto" class="CToWUd"><span style="color:#5f6368;font-family:Arial,Helvetica,sans-serif;font-weight:400;font-size:22px;line-height:26px;vertical-align:middle;padding-left:11px">Optimize</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:20px" align="center" valign="top" width="100%">
                                                    <table style="border:0 none;border-collapse:collapse" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td class="m_4541953067113816025mod-container-td" style="border:1px solid #eef0f1;border-collapse:collapse;font-family:Roboto,sans-serif" align="center" bgcolor="#ffffff" valign="top" width="100%">
                                                                    <table style="border:0 none;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:25px 30px" width="100%">
                                                                                    <table style="border:0 none;border-collapse:collapse" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="m_4541953067113816025copy" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:16px;line-height:26px;padding:10px 0 0;padding-top:0"
                                                                                                    align="center" width="100%"><img title="Google Optimize" alt="Google Optimize" src="http://localhost/sitendik/'.$path.'"
                                                                                                        style="border:0 none;display:block;height:auto;max-height:auto;max-width:300px" border="0" width="300" height="auto" class="CToWUd a6T" tabindex="0">
                                                                                                    <div
                                                                                                        class="a6S" dir="ltr" style="opacity: 0.01; left: 511.5px; top: 289px;">
                                                                                                        <div id=":1gy" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" title="Download" role="button" tabindex="0" aria-label="Download lampiran " data-tooltip-class="a1V">
                                                                                                            <div class="aSK J-J5-Ji aYr"></div>
                                                                                                        </div>
                </div>
                </td>
                </tr>
                <tr>
                    <td class="m_4541953067113816025image-title" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:24px;line-height:32px;padding:10px 0 0" align="center" width="100%">Photo Profil Berhasil Diperbaharui</td>
                </tr>
                <tr>
                    <td class="m_4541953067113816025copy" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:16px;line-height:26px;padding:10px 0 0;padding-top:20px" width="100%">Pelanggan '.$email.' yang Terhormat,</td>
                </tr>
                <tr>
                    <td class="m_4541953067113816025copy" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:16px;line-height:26px;padding:10px 0 0" width="100%">Uji coba Anda, <i>Pendidikan</i>, di GTM-WGC7KNC, telah dimulai dan kini sedang ditampilkan kepada pengunjung yang ditargetkan. Uji coba ini secara otomatis akan berakhir setelah 90 hari pada 2019 Des 26. Anda akan mulai melihat hasil
                        dalam laporan Optimize setelah beberapa hari.</td>
                </tr>
                <tr>
                    <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:20px 0" align="center" width="100%">
                        <div><a href="http://localhost/sitendik/index.php"
                                style="background-color:#4285f4;background-image:url(https://ci5.googleusercontent.com/proxy/p3Y6Q5XlOM_L7nWERQbhB7fNnmShTO4yMJbBdxnA8Tpgsa1DdD_CxbvS-UTeyNgfaaZC3oylvGbgYbg23l4JkyvL3EP5_LH9UI1ck-3765emAEXmT-3ycAeXvWaO=s0-d-e1-ft#http://services.google.com/fh/files/emails/cta_btn_bgcolor_4285f4_5x40.png);border:px;border-color:#4285f4;border-radius:3px;border-style:solid;color:#ffffff;display:inline-block;font-family:Roboto,Helvetica,sans-serif;font-size:16px;font-weight:600;line-height:35px;padding:0 5px;text-align:center;text-decoration:none;width:180px"
                                bgcolor="#4285f4" align="center" width="180" target="_blank" >Lihat Uji Coba</a></div>
                    </td>
                </tr>
                <tr>
                    <td class="m_4541953067113816025copy" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:16px;line-height:26px;padding:10px 0 0;padding-top:0" width="100%"><a href="https://support.google.com/optimize/answer/6218117?utm_source=opt_notifications&amp;utm_medium=email&amp;utm_campaign=opt_exp_notifications&amp;utm_content=opt_exp_hc_started" style="color:#4285f4;text-decoration:none" target="_blank"
                            data-saferedirecturl="https://www.google.com/url?q=https://support.google.com/optimize/answer/6218117?utm_source%3Dopt_notifications%26utm_medium%3Demail%26utm_campaign%3Dopt_exp_notifications%26utm_content%3Dopt_exp_hc_started&amp;source=gmail&amp;ust=1577982224801000&amp;usg=AFQjCNGnZ2dOniFx0jhl2OU_hAD-AyE6Pg">Pelajari lebih lanjut</a>                        cara menafsirkan laporan Optimize.</td>
                </tr>
                <tr>
                    <td class="m_4541953067113816025copy" style="border-collapse:collapse;color:#5f6368;font-family:Roboto,sans-serif;font-size:16px;line-height:26px;padding:10px 0 0;padding-top:20px" width="100%">Selamat Menguji!<br><strong>Tim Google Optimize</strong></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                <tr>
                    <td style="border-collapse:collapse;font-family:Roboto,sans-serif;font-size:1px;line-height:1px;padding:0" bgcolor="#dbdddd" height="1" valign="top" width="100%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-collapse:collapse;font-family:Roboto,sans-serif;font-size:1px;line-height:1px;padding:0" bgcolor="#e7e9ea" height="1" valign="top" width="100%">&nbsp;</td>
                </tr>
                <tr>
                    <td style="border-collapse:collapse;font-family:Roboto,sans-serif;font-size:1px;line-height:1px;padding:0" bgcolor="#eef0f1" height="1" valign="top" width="100%">&nbsp;</td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                <tr>
                    <td style="border-collapse:collapse;font-family:Roboto,sans-serif;padding:25px 30px" align="center" bgcolor="#ffffff" valign="top" width="100%">
                        <table style="border:0 none;border-collapse:collapse" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td style="border-collapse:collapse;color:#999999;font-family:Roboto,sans-serif;font-size:10px;line-height:14px;padding:0 0 15px" align="center" valign="top" width="100%"><span class="m_4541953067113816025ios-link-footer-addr" style="color:#999999;text-decoration:none"><font><a href="#m_4541953067113816025_not-a-link" style="color:#999999;text-decoration:none">Google LLC 1600 Amphitheatre Parkway, Mountain View, CA 94043</a></font></span></td>
                                </tr>
                                <tr>
                                    <td style="border-collapse:collapse;color:#999999;font-family:Roboto,sans-serif;font-size:10px;line-height:14px;padding:0 0 15px;padding-bottom:0" align="center" valign="top" width="100%">Anda menerima email ini karena telah menyatakan bersedia menerima pemberitahuan penting yang terkait dengan uji coba <i>Pendidikan</i>. Jika Anda tidak ingin menerima email semacam ini di masa mendatang, Anda dapat
                                        berhenti berlangganan dari uji coba ini <a href="https://optimize.google.com/optimize/home/#/accounts/4702909658/containers/13047663/experiments/6" style="color:#4285f4;text-decoration:none" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://optimize.google.com/optimize/home/%23/accounts/4702909658/containers/13047663/experiments/6&amp;source=gmail&amp;ust=1577982224802000&amp;usg=AFQjCNHouIoDUhXrWbCtMnjIpfuSBFfGqQ">di sini</a>.</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                </div>
            </td>
        </tr>
    </tbody>
</table>';
  $subject = "Update Profil";
  
  $user_profil->send_mail($email,$message,$subject);
  
  $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     We've sent an email to $email.
                    Please click on the password reset link in the email to generate new password. 
      </div>";
 }
 else
 {
  $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong>  this email not found. 
       </div>";
 }
 header("location:profil.php");
}
}
?>