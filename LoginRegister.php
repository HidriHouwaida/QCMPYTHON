<?php

session_start();
include 'config.php';
error_reporting(0);
if(isset($_POST["signup"]))
{
  $full_name=mysqli_real_escape_string($conn,$_POST['signup_full_name']);
  $email=mysqli_real_escape_string($conn,$_POST['signup_email']);
  $password=mysqli_real_escape_string($conn,md5($_POST['signup_password']));
  $cpassword=mysqli_real_escape_string($conn,md5($_POST['signup_cpassword']));
  $check_email=mysqli_num_rows(mysqli_query($conn,"SELECT email FROM users WHERE email='$email'"));
  if($password!==$cpassword)
  {
   echo "<script>alert('Password did not match');</script>";
  }
  elseif($check_email>0)
  {
    echo "<script>alert('Email already exist ');</script>";
  }
  else
  {
    $sql="INSERT INTO users (full_name,email,password) VALUES ('$full_name','$email','$password')";
    $result=mysqli_query($conn,$sql);
    if($result)
    { $_POST['signup_full_name']="";
      $_POST['signup_email']="";
      $_POST['signup_password']="";
      $_POST['signup_cpassword']="";
      echo "<script>alert('User registration successfully ');</script>";
    }
    else
    {
      echo "<script>alert('User registration failed ');</script>";
    }
  }
}
if(isset($_POST["signin"]))
{
  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $password=mysqli_real_escape_string($conn,md5($_POST['password']));
  $check_email=mysqli_query($conn," SELECT id FROM users WHERE email='$email' and password='$password' ");
  
  
   if(mysqli_num_rows($check_email)>0)
   { 
    echo "<script>alert('Sign in successful');</script>";
    header("Location:Menu.html");
   }
   else
   {
    echo "<script>alert('Login details are incorrect Pleas try again ');</script>";
   }
  
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" method="POST" class="sign-in-form">
            <h2 class="title">Se Connecter</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" name="email" value="<?php echo $_POST['email'];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Mot De Passe" name="password" value="<?php echo $_POST['password'];?>" required />
            </div>
            <input type="submit" value="Connexion" name="signin" class="btn solid" />
          </form>


          <form action="" class="sign-up-form" method="POST">
            <h2 class="title">Créer Un Compte</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nom & Prénom" name="signup_full_name" value="<?php echo $_POST["signup_full_name"];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email " name="signup_email"value="<?php echo $_POST["signup_email"];?>" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Mot De Passe" name="signup_password" value="<?php echo $_POST["signup_password"];?>" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Confirmation de Mot de passe" name="signup_cpassword"value="<?php echo $_POST["signup_cpassword"];?>" required />
            </div>
            <input type="submit" class="btn" name="signup" value="S'inscrire" />
           
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="images/background.jpg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <button class="btn transparent" id="sign-in-btn">
              Se Connecter
            </button>
          </div>
          <img src="images/background.jpg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>
