<?php 
          if (isset($_GET['p_id'])){
            $edit_post_id =  $_GET['p_id'];
             
           

          
            $query = "SELECT * FROM posts WHERE post_id ={$edit_post_id}";
            $select_posts = mysqli_query($connection, $query); 

           if(!$select_posts){
             echo"quey failed";}
           

            while($row = mysqli_fetch_assoc($select_posts)){
           

           $Post_ID   = $row['post_id'];       
           $Post_Cat_Id  = $row['post_cat_id'] ;  
           $Post_title = $row['post_title'] ;  
           $Post_author = $row['post_author'];   
           $Post_date = $row['post_date'] ; 
           $Post_image = $row['post_image'] ; 
           $Post_content = $row['post_content'];  
           $Post_tags = $row['post_tags']  ;
           $Post_coment = $row['post_coment_count'];  
           $Post_status = $row['post_status'] ; 
             
            }
          }
  ?>
  
  
  
  <?php
  if(isset($_POST['edit_post']))
  {
   // echo $_POST['title'];
    $post_title = $_POST['title'];
    $post_category = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES["image"]["name"];
  

    $post_image_temp = $_FILES["image"]["tmp_name"];


    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date= date('d-m-y');
    $post_comment_count = 4;


   move_uploaded_file($post_image_temp, "../images/$post_image");

   if(empty($post_image)){
     $query = "SELECT * FROM posts WHERE post_id = $edit_post_id ";

     $select_image = mysqli_query($connection, $query);
     while($row = mysqli_fetch_assoc($select_image)){
       $post_image = $row['post_image'];
     }
   }
   
 $query = "UPDATE posts SET ";
$query .= "post_title =  '{$post_title}', ";
$query .= "post_cat_id =  '{$post_category}', ";
$query .= "post_author =  '{$post_author}', ";
$query .= "post_status =  '{$post_status}', ";
$query .= "post_cat_id =  '{$post_category}', ";
$query .= "post_tags=  '{$post_tags}', ";
$query .= "post_content =  '{$post_content}', ";
$query .= "post_date =  now(), ";
$query .= "post_image =  '{$post_image}' ";
$query .= "WHERE post_id = {$edit_post_id} ";


$set_post_query = mysqli_query($connection,$query);

      if(!$set_post_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }
echo "<p class ='bg-success'>Post Updated : "." "."<a href='../post.php?p_id={$edit_post_id}'>View Post</a></p> ";
    }
  ?>
  
  
  <form action=""  method="post"  enctype ="multipart/form-data">
    <div class="form-group">
    <label for="title">Post Title</label>
    <input value ="<?php echo $Post_title;?>" class= "form-control" type="text" name="title">
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
            
          if($cat_Id == $Post_Cat_Id){
            echo "<option  value='{$cat_Id}' selected>$cat_Title</option>";
          }
          else{
             echo "<option value='{$cat_Id}'>$cat_Title</option>";
             
          }
          }
        ?>
    </select>
    </div>


    <div class="form-group">
    <label for="post_author">Post Author</label>
    <input value ="<?php echo $Post_author;?>" class= "form-control" type="text" name = "post_author">
    </div>

    <div class="form-group">


    <select name="post_status" id="">
   <option value=''><?php echo $Post_status;?></option>
   <?php
   if($Post_status == 'published'){
      echo "<option value='draft'>Draft</option>";
   }else{
     echo "<option value='published'>Published</option>";
   }
  ?>
    </select>
    
    </div>


    <div class="form-group">
    <label for="image">Post Image</label>
    <!-- <img width = 100 src ="../images/<?php echo $Post_image;?>"alt="image"> -->
    <input  type= "file" name= "image" id = "post_image" >
    </div>


    <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value ="<?php echo $Post_tags;?>" class= "form-control" type="text" name = "post_tags">
    </div>



    <div class="form-group">
    <label for="post_content">Post content</label>
    <textarea  class= "form-control" type="text" name = "post_content" id ="" cols= "30" rows ="10"><?php echo $Post_content;?></textarea>
    </div>


    <div class="form-group">
    
    <input class= "btn btn-primary" type="submit" name = "edit_post" value ="Edit Post">
    </div>

    