

<?php
include "modal.php";

if(isset($_POST['checkBoxArray'])){


     foreach($_POST['checkBoxArray'] as $checkBoxValue){
   
        echo $bulk_options = $_POST['bulk_option'];
   
        echo $checkBoxValue;

}
}

?>
  

  <form action="" method = "post">
     <table class="table table-bordered table-hover">
     <div id="bulkOptionContainer" class="col-xs-4">
     <select class="form-control" name="bulk_option" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    
     </select>
     
    </div>
     <div id="col-xs-4">
     <input type="submit" name="submit" class="btn btn-success" value="Apply">
     <a class ="btn btn-primary" href="posts.php?source=add_post">Add New</a>

     </div>
            <thead>
            <tr>
                <th><input id="select_all_boxes" type="checkbox" ></th>
                <th>Post_ID</th>
                <th>Post_Category</th>
                <th>Post_title</th>
                <th>Post_author</th>
                <th>Post_date</th>
                <th>Post_image</th>
                <!-- <th>Post_content</th> -->
                <th>Post_tags</th>
                <th>Post_coment</th>
                <th>Post_views</th>
                <th>Post_status</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
                
              
            </tr>
            </thead>
            <tbody>
            <?php
          
            $query = " SELECT posts.post_id as post_id,posts.post_cat_id as post_cat_id ,posts.post_title as post_title ,posts.post_author as post_author,posts.post_user as post_user,posts.post_date as post_date, ";
            $query .= " posts.post_image as post_image,posts.post_content as post_content,posts.post_tags as post_tags,posts.post_coment_count as post_coment_count,posts.post_views as post_views, ";
            $query .= " posts.post_status as post_status,categories.cat_Title as cat_Title";
            $query .= " FROM posts";
            $query .= " LEFT JOIN categories ON posts.post_cat_id = categories.cat_Id ";
            $query .= " ORDER BY posts.post_id DESC ";
            //echo $query;
            $select_posts = mysqli_query($connection, $query); 
            //echo $select_posts;
           if(!$select_posts){
             echo"quey failed";}
           

            while($row = mysqli_fetch_assoc($select_posts)){
           

           $Post_ID   = $row['post_id'];   

           $Post_Cat_Id  = $row['post_cat_id'] ;  
           $Post_title = $row['post_title'] ;  
         


           $Post_author = $row['post_author']; 
           
           $Post_user = $row['post_user'];

           $Post_date = $row['post_date'] ; 
           $Post_image = $row['post_image'] ; 
          //  $Post_content = $row['post_content'];
           
           $Post_tags = $row['post_tags']  ;

         
           $Post_coment = $row['post_coment_count']; 
           $Post_views = $row['post_views'] ;   
           $Post_status = $row['post_status'] ; 
           
           $cat_Title = $row['cat_Title'];
           
            echo"<tr>";
            ?>
           <td> <input class='checkBoxes' id='select_all_boxes' type='checkbox'name='checkBoxArray[]' value='<?php echo $Post_ID; ?>'></td>



            <?php
            echo "<td>$Post_ID</td>";

          //  $query = "SELECT * FROM categories WHERE cat_Id = {$Post_Cat_Id} ";
          //                   $edit_categories = mysqli_query($connection, $query); 
                            
          //                   while($row = mysqli_fetch_assoc($edit_categories)){
                                
          //                           $cat_Title = $row['cat_Title'];
                          
     
          //                   }

            echo "<td>$cat_Title</td>";
            echo "<td>$Post_title</td>";
            if(!empty($Post_author)){

            echo "<td>$Post_author</td>";
            }
            elseif(!empty($Post_user)){
            echo "<td>$Post_user</td>";
            }
            echo "<td>$Post_date</td>";
            echo "<td><img width = '100'src = '../images/$Post_image' alt ='images'</td>";
            // echo "<td>$Post_content</td>";
            echo "<td>$Post_tags</td>";

            $comment_query =  "SELECT * FROM comments where comment_post_id = $Post_ID ";
            $send_comment_query = mysqli_query($connection,$comment_query);
            $comment_count = mysqli_num_rows($send_comment_query);

           while($row = mysqli_fetch_array($send_comment_query)){
            $comment_id = $row['comment_id'];
           }
            echo "<td><a href = 'post_comments.php?id={$Post_ID}'>$comment_count</a></td>";
            echo "<td><a href ='posts.php?reset={$Post_ID}'>$Post_views</a></td>";
            echo "<td>$Post_status</td>";
            echo "<td><a href ='../post.php?p_id={$Post_ID}'>View Post</a></td>";
             echo "<td><a href ='posts.php?source=edit_post&p_id={$Post_ID}'>Edit</a></td>";
            
            echo "<td><a rel = '$Post_ID' href ='javascript:void(0)' class ='delete_link'>Delete</a></td>";
           
           // echo "<td><a href ='posts.php?delete={$Post_ID}'>Delete</a></td>";
           
           echo"</tr>";
          }
          
          ?>
          </tbody>
         
          </table>
  </form>

           <?php 
            if(isset($_GET['delete'])){


              $del_post_id = $_GET['delete'];
              $query = "DELETE FROM posts WHERE post_id = {$del_post_id} ";

              $delete_post_query = mysqli_query($connection,$query);
             // header("Location: view_all_posts.php");

            header("Location: posts.php");
            if(!$delete_post_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

    }


    if(isset($_GET['reset'])){


              $reset_post_id = $_GET['reset'];
              $query = "UPDATE posts SET post_views = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']). " ";

              $delete_post_query = mysqli_query($connection,$query);
             // header("Location: view_all_posts.php");

            header("Location: posts.php");
            if(!$delete_post_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

    }
          
           ?>


<script>

$(document).ready(function(){

    $(".delete_link").on('click',function(){
     let id = $(this).attr("rel");
    let delete_url = "posts.php?delete="+ id +"";
    $(".modal_delete_link").attr("href", delete_url);
    $("#deleteModal").modal('show');
 });
  

});



</script>
          

          
