<?php 
          if (isset($_GET['p_id'])){
            $edit_user_id =  $_GET['p_id'];
             
          
          
            $query = "SELECT * FROM users WHERE user_id ={$edit_user_id}";
            $select_users = mysqli_query($connection, $query); 

              if(!$select_users){
                echo"quey failed";}
              

              while($row = mysqli_fetch_assoc($select_users)){
            
                $user_name= $row['username'];
    
                $User_firstname = $row['user_firstname'];
                $User_secondname = $row['user_secondname'];
            
                $user_role = $row['user_role'];
                $user_email= $row['user_email'];
                $user_password= $row['user_password'];

           
            }
          }
  ?>
  
   <?php
      if(isset($_POST['update_user']))
      {
      // echo $_POST['title'];
        $user_name= $_POST['username'];
      
        $User_firstname = $_POST['User_firstname'];
        $User_secondname = $_POST['User_secondname'];
   
  
        $user_role = $_POST['user_role'];
        $user_email= $_POST['user_email'];
        $user_password= $_POST['user_password'];

        $user_password = password_hash($user_password, PASSWORD_BCRYPT,array('cost'=>10));
    
   }
   
 $query = "UPDATE users SET ";
$query .= "username =  '{$user_name}', ";
$query .= "user_firstname =  '{$User_firstname}', ";
$query .= "user_secondname =  '{$User_secondname}', ";
$query .= "user_role =  '{$user_role}', ";
$query .= "user_password =  '{$user_password}', ";
$query .= "user_email=  '{$user_email}' ";
//$query .= "post_content =  '{$post_content}', ";
//$query .= "post_date =  now(), ";
//$query .= "post_image =  '{$post_image}' ";
$query .= "WHERE user_id = {$edit_user_id} ";


$set_user_query = mysqli_query($connection,$query);

      if(!$set_user_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }
 
  
    
  
  ?> 
  
  
  <form action=""  method="post"  enctype ="multipart/form-data">
    <div class="form-group">
    <label for="username"> username</label>
    <input value = "<?php echo $user_name;?>"class= "form-control" type="text" name="username">
    </div>

    <div class="form-group">
    <label for="User_firstname"> Firstname</label>
    <input value = "<?php echo $User_firstname;?>" class= "form-control" type="text" name = "User_firstname">
    </div>

    <div class="form-group">
    <label for="User_secondname">SecondName</label>
    <input value = "<?php echo $User_secondname;?>" class= "form-control" type="text" name = "User_secondname">
    </div>


    <div class="form-group"> 
    <label for="user_role">user_role</label>
    <select name="user_role" id="user_role">
     <option value="admin">Admin</option>
     <option value="subscriber">Subscriber</option>
    </select>
    </div>


    <!-- <div class="form-group">
    <label for="user_image">user_image</label>
    <input  type= "file" name= "user_image" id = "user_image" >
    </div> -->


    <div class="form-group">
    <label for="user_password">Password </label>
    <input autocomplete= off value = "" class= "form-control" type="password" name = "user_password">
    </div>

   
    <div class="form-group">
    <label for="user_email">Email</label>
    <input autocomplete=off value = "" class= "form-control" type="text" name = "user_email">
    </div>


    <div class="form-group">
    
    <input class= "btn btn-primary" type="submit" name = "update_user" value ="update User">
    </div>

    