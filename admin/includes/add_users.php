  <?php
  if(isset($_POST['create_user']))
  {
    
    $user_name= $_POST['username'];
   
    $User_firstname = $_POST['User_firstname'];
    $User_secondname = $_POST['User_secondname'];
    //$post_image = $_FILES["image"]["name"];
  

   // $post_image_temp = $_FILES["image"]["tmp_name"];


  
    $user_role = $_POST['user_role'];
    $user_email= $_POST['user_email'];
    $user_password= $_POST['user_password'];

    $user_password = password_hash($user_password, PASSWORD_BCRYPT,array('cost'=>10));
    //$id = ''; 
    // if(isset($_POST['image'])) {

    //     $id = $_FILES['image'];  
    //     echo $id;
    // }else{
    //   echo"id is blank";
    // } 

  
  //  move_uploaded_file($post_image_temp, "../images/$post_image");
   
 $query = "INSERT INTO users(username, user_password,user_firstname, 
user_secondname, user_email, user_role) ";

$query .= 
"VALUES('{$user_name}','{$user_password}','{$User_firstname}','{$User_secondname}','{$user_email}','{$user_role}') ";

$creat_user_query = mysqli_query($connection,$query);

      if(!$creat_user_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }
echo "User Created: "." "."<a href='users.php'>View Users</a> ";
    }
  ?>
  
  
  <form action=""  method="post"  enctype ="multipart/form-data">
    <div class="form-group">
    <label for="username"> username</label>
    <input class= "form-control" type="text" name="username">
    </div>

    <div class="form-group">
    <label for="User_firstname"> Firstname</label>
    <input class= "form-control" type="text" name = "User_firstname">
    </div>

    <div class="form-group">
    <label for="User_secondname">SecondName</label>
    <input class= "form-control" type="text" name = "User_secondname">
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
    <input class= "form-control" type="password" name = "user_password">
    </div>

   
    <div class="form-group">
    <label for="user_email">Email</label>
    <input class= "form-control" type="text" name = "user_email">
    </div>


    <div class="form-group">
    
    <input class= "btn btn-primary" type="submit" name = "create_user" value ="Add User">
    </div>

    