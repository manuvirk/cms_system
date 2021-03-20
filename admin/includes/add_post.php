<?php include_once "function.php" ?>
 
<?php 
  
  if(isset($_POST['create_post']))
  {

    $post_title = $_POST['title'];
    $post_category = $_POST['post_category'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES["image"]["name"];
  

    $post_image_temp = $_FILES["image"]["tmp_name"];


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date= date('d-m-y');
    $post_comment_count = 0;

    //$id = ''; 
    // if(isset($_POST['image'])) {

    //     $id = $_FILES['image'];  
    //     echo $id;
    // }else{
    //   echo"id is blank";
    // } 

  
   move_uploaded_file($post_image_temp, "../images/$post_image");
   
      $query = "INSERT INTO posts( post_cat_id, post_title,post_user, 
      post_date, post_image, post_content, post_tags, post_coment_count, post_status) ";

      $query .= 
      "VALUES('{$post_category}','{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_comment_count}','{$post_status}' ) ";

      $creat_post_query = mysqli_query($connection,$query);


      if(!$creat_post_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

    }
  ?>
  
  
  <form action=""  method="post"  enctype ="multipart/form-data">
    <div class="form-group">
      <label for="title">Post Title</label>
      <input class= "form-control" type="text" name="title">
    </div>


  
    <div class="form-group">
    <label for="post_category">Post_category</label>
    <select name="post_category" id="post_category">
    <?php
            $query = "SELECT * FROM categories";
            $select_post_categories = mysqli_query($connection, $query); 
                                  
            while($row = mysqli_fetch_assoc($select_post_categories)){
              $cat_Id =  $row['cat_Id'];                      
              $cat_Title = $row['cat_Title'];
          
              echo "<option value='{$cat_Id}'>$cat_Title</option>";
            }
          
    ?>
    </select>
    </div>

<div class="form-group">
    <label for="post_user">Post_users</label>
    <select name="post_user" id="post_users">
    <?php
      $result = query("SELECT * FROM users");
      confirmQuery($result);
     
      while($row = mysqli_fetch_assoc($result)){
         $user_Id =  $row['user_id'];                      
         $username = $row['username'];
    
         echo "<option value='{$username}'>$username</option>";
      }
    
    ?>
    </select>
    </div>



    <!-- <div class="form-group">
    <label for="post_author">Post Author</label>
    <input class= "form-control" type="text" name = "post_author">
    </div> -->

    <div class="form-group">
    <label for="post_status">Post Status</label>
     <select name="post_status" id="">
            <option value="draft"> Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
     </select>    
    </div>


    <div class="form-group">
    <label for="image">Post Image</label>
    <input  type= "file" name= "image" id = "post_image" >
    </div>


    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input class= "form-control" type="text" name = "post_tags">
    </div>



    <div class="form-group">
    <label for="post_content">Post content</label>
    <textarea class= "form-control" type="text" name = "post_content" id ="content" cols= "30" rows ="10"></textarea>
    </div>


    <div class="form-group">
    
    <input class= "btn btn-primary" type="submit" name = "create_post" value ="Publish Post">
    </div>

    