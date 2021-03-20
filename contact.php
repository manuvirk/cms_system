<?php  include "include/db.php"; ?>
 <?php  include "include/header.php"; ?>
<?php 
if(isset($_POST['sendemail'])){
    $subject = $_POST['subject'];
    $header = $_POST['email'];
    $message = wordwrap($_POST['message'], 70);

  mail("virkmanu1991@gmail.com",$subject, $message,$header);

 
}


?>

    <!-- Navigation -->
    
    <?php  include "include/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1 class="text-center">Contact Us</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    
                       
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">subject</label>
                            <input type="subject" name="subject" id="key" class="form-control" placeholder="subject">
                        </div>
                         <div class="form-group">
                            <label for="message" class="sr-only">message</label>
                            
                           <textarea name="message" class="form-control" id="message" ></textarea>
                        </div>

                
                        <input type="submit" name="sendemail" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "include/footer.php";?>
