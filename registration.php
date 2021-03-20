
<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
  <?php  include "include/navigation.php"; ?>
  <?php  include "admin/function.php"; ?>
  
<?php 
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = trim($_POST['username']);
  
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
   

   $error = ['username'=> '',
   'email'=>'',
   'password'=>''];

   if(strlen($username)<4){
       $error['username'] = 'username needs to be longer';

   }
   if($username == ''){
       $error['username']='username cannot be empty';
    
   }
   if(user_exits($username)){
       $error['username'] = 'username already exists';   }
  
if(email_exits($email)){
       $error['email'] = 'email already exists,<a href="index.php">Please login</a>';   }

if($password == ''){
    $error['password'] = 'Password cannot be empty';
}

foreach($error as $key =>$value){
    if(empty($value)){
        unset($error[$key]);
    }}

    if(empty($error)){
    register_user($username, $email, $password);
    //login_user($username,$password);
    }

}





?>

    <!-- Navigation -->
    
   
    
 
    <!-- Page Content -->
<div class="container ">

<section id="login">
    <div class="container"id ="content_reg">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                 <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="on">
                    <!-- <h6 class = "text-center"><?php //echo $message;?></h6> -->
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username"
                             autocomplete="on">
                            <p><?php echo isset($error['username'])? $error['username']: ''?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com"
                             autocomplete="on" value="<?php echo isset($email)? $email: ''?>">
                            <p><?php echo isset($error['email'])? $error['email']: ''?></p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password"
                             autocomplete="on">
                            <p><?php echo isset($error['passeord']) ? $error['password']: ''?></p>
                        </div>
                
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
</div>

        <hr>



<?php include "include/footer.php";?>
