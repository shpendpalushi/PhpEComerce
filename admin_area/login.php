

<html lang="en-US">
<head>
  <meta charset="utf-8">
    <title>Login</title>
    
    <link rel="stylesheet" href="styles/login_admin.css">
</head>
<body>
    <div id="login">
      <form method="post">
        <span class="fontawesome-user"></span>
          <input type="text" id="user" placeholder="Email" name="email" required>
       
        <span class="fontawesome-lock"></span>
          <input type="password" id"pass" placeholder="Fjalekalim" name="password" required>
        
        <input type="submit" value="Login" name="mylogin" >
      </form>
    </div>
</body>
</html>
<?php
    session_start();
    include("../includes/database.php");
    if(isset($_POST['mylogin'])){
        $email = mysqli_real_escape_string($con,$_POST['email']);
        echo $email;
        $password = mysqli_real_escape_string($con,$_POST['password']);
        $zgjidh_user ="select * from admins where user_email='$email' and user_password='$password'";
        $ekzekuto_user = mysqli_query($con, $zgjidh_user);

        if(mysqli_num_rows($ekzekuto_user)==0){
            echo "<script>alert('Your credentials were incorrect')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
        }else{
            $_SESSION['user_email'] = $email;
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }

?>