 <table class="table table-bordered table-hover">
            <thead>
            <tr>
              
                <th>Comment_ID</th>
               <!-- <th>Comment_post_id</th> -->
              
                <th>Comment_author</th>
                  <th>Comment_date</th>
                <th>Comment_email</th>
              
                <th>Comment_content</th>
                <th>Response To</th>
                <th>Comment_status</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Delete</th>
              
            </tr>
            </thead>
            <tbody>
            <?php
          
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection, $query); 

           if(!$select_comments){
             echo"quey failed";}
           

            while($row = mysqli_fetch_assoc($select_comments)){
           

           $comment_ID   = $row['comment_id'];   

           $comment_post_Id  = $row['comment_post_id'] ;  
           //$comment_title = $row['comment_title'] ;  
           
           $comment_date = $row['comment_date'] ; 
           $comment_author = $row['comment_author'];   
           $comment_email = $row['comment_email'] ; 
           $comment_content = $row['comment_content'];  
    
           $comment_status = $row['comment_status'] ; 
           
            echo"<tr>";
            echo "<td>$comment_ID</td>";

          //  $query = "SELECT * FROM categories WHERE cat_Id = {$Post_Cat_Id} ";
          //                   $edit_categories = mysqli_query($connection, $query); 
                            
          //                   while($row = mysqli_fetch_assoc($edit_categories)){
                                
          //                           $cat_Title = $row['cat_Title'];
                          
     
          //                   }

           // echo "<td>$comment_post_Id</td>";
           
            echo "<td>$comment_author</td>";
            echo "<td>$comment_date</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_content</td>";

                $query = "SELECT * FROM posts WHERE post_id = $comment_post_Id ";
                $comment_post_title = mysqli_query($connection,$query); 
           
                while($row = mysqli_fetch_assoc($comment_post_title)){
                        
                    $post_Title = $row['post_title'];
                    $post_id = $row['post_id'];
                    echo "<td><a href ='../post.php?p_id= $post_id'>$post_Title</a></td>";
                                    
            }
            echo "<td>$comment_status</td>";
            echo "<td><a href ='comment.php?approve=$comment_ID'>Approve</a></td>";
            echo "<td><a href ='comment.php?unapprove=$comment_ID'>Unapprove</a></td>";
            echo "<td><a href ='comment.php?delete=$comment_ID'>Delete</a></td>";
            
            echo"</tr>";

            
          }
          
          ?>
          </tbody>
         
           </table>


           <?php 
            if(isset($_GET['approve'])){


              $approve_comment_id = $_GET['approve'];
              $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$approve_comment_id} ";

              $approve_comment_query = mysqli_query($connection,$query);
              header("Location: comment.php");

  
            if(!$delete_post_query){
            die('QUERY FAILED'. mysqli_error($connection));
             }

             }

            if(isset($_GET['unapprove'])){    


              $unapprove_comment_id = $_GET['unapprove'];
              $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$unapprove_comment_id} ";

              $unapprove_comment_query = mysqli_query($connection,$query);
              header("Location: comment.php");

  
            if(!$delete_post_query){
            die('QUERY FAILED'. mysqli_error($connection));
             }

             }









            if(isset($_GET['delete'])){


              $del_comment_id = $_GET['delete'];
              $query = "DELETE FROM comments WHERE comment_id = {$del_comment_id} ";

              $delete_comment_query = mysqli_query($connection,$query);
              header("Location: comment.php");

  
            if(!$delete_post_query){
            die('QUERY FAILED'. mysqli_error($connection));
             }

             }
          
           ?>



          

          
