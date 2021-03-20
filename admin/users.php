<?php include "includes/admin_header.php";?>
<?php 
   if(!is_admin($_SESSION['username'])){
     header("Location:index.php");

   }

?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
            <div class="col-lg-12">
            <h1 class="page-header">
                Welcome to Admin
                <small>Author</small>
            </h1>

        <?php
        if(isset($_GET['source'])){
         $source = $_GET['source'];

        }
        else{
          $source = '';
        }
        switch($source)   {

          case 'add_users';
          include "includes/add_users.php";
          
          break;

          case 'edit_users';
          include "includes/edit_users.php";
          break;

          default:
          include "includes/view_all_users.php";
          
  
        }
?>
            <div class="col-xs-6">
           
          

    </div>
        <?php include "includes/admin_footer.php";?>
