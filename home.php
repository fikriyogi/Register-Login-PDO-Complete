<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('index.php');
}

// $stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt = $user_home->runQuery("
    SELECT * FROM tbl_users, tbl_profil WHERE tbl_users.userID=:uid AND tbl_profil.id_user=:uid;
    -- SELECT * FROM tbl_profil WHERE id_user=:uid;
    -- INSERT INTO tbl_profil(hp) VALUES(:user_hp)
    ");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#"><?php if($row['userType']=="4") { echo "Member"; } else { echo "Pegawai"; } ?> Home</a>

                    <img name="photo" src="user_images/<?php if(empty($row['photo'])) { echo "laki.jpg"; } else { echo $row['photo']; } ?>">
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> <?php echo $row['userEmail']; ?> <?php echo $row['hp']; ?> <?php echo $row['nama_lengkap']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="http://www.codingcage.com/">Coding Cage</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tutorials <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <!-- profil.php?edit_id=<?php echo $_SESSION['userSession']; ?> -->
                                    <li><a class="btn btn-info" href="profil.php" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
                                    <li><a href="profil.php?id=<?php echo $row['id']; ?>"> edit </a></li>

                                </ul>
                            </li>
                            
                            
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>

        <div>
                
            <?php
            $host = "localhost";
            $user = "root";
            $password = "";
            $database_name = "sitendik";
            $pdo = new PDO("mysql:host=$host;dbname=$database_name", $user, $password, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ));
            $query = $pdo->prepare("select * from tbl_users");
            $query->execute();
            ?>
            <table>
            <tr>
                <td>Nis</td>
                <td>Nama</td>
                <td>Jenis Kelamin</td>
                <td>TGL Lahir</td>
            </tr>
            <?php while($siswa = $query->fetch()){?>
            <tr>
                <td><?php echo $siswa['userID']?></td>
                <td><?php echo $siswa['userName']?></td>
                <td><?php echo $siswa['userEmail']?></td>
                <td><?php echo $siswa['userStatus']?></td>
            </tr>
            <?php } ?>
            </table>
        </div>
        
        <!--/.fluid-container-->
        
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>