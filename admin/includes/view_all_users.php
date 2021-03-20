 <table class="table table-bordered table-hover">
            <thead>
            <tr>
              
                <th>User_ID</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Secondname</th>
                <!-- <th>Password</th> -->
                <!-- <th>UserImage</th> -->
                <th>UserEmail</th>
                <th>Userrole</th>
                <th>Userrandsalt</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>
                
              
            </tr>
            </thead>
            <tbody>
            <?php
          
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query); 

           if(!$select_users){
             echo"quey failed";}
           

            while($row = mysqli_fetch_assoc($select_users)){
           

           $User_ID   = $row['user_id'];   

          
           $Username = $row['username'] ;  
           
           $User_firstname = $row['user_firstname'] ; 
           $User_secondname = $row['user_secondname'] ; 
          //  $User_password = $row['user_password'];   
          //  $User_image = $row['user_image']  ;
           $User_email = $row['user_email'];  
          
           $User_role = $row['user_role'];  
           $User_randsalt = $row['user_randsalt'] ; 
           
            echo"<tr>";
            echo "<td>$User_ID</td>";

          //  $query = "SELECT * FROM categories WHERE cat_Id = {$Post_Cat_Id} ";
          //                   $edit_categories = mysqli_query($connection, $query); 
                            
          //                   while($row = mysqli_fetch_assoc($edit_categories)){
                                
          //                           $cat_Title = $row['cat_Title'];
                          
     
          //                   }

            echo "<td>$Username</td>";
            echo "<td> $User_firstname</td>";
            echo "<td>$User_secondname</td>";
            // echo "<td>$User_password</td>";
            // echo "<td><img width = '100'src = '../images/$User_image' alt ='images'</td>";
            echo "<td>$User_email</td>";
            echo "<td>$User_role</td>";
            echo "<td>$User_randsalt</td>";
             echo "<td><a href ='users.php?change_to_admin=$User_ID'>Admin</a></td>";
            echo "<td><a href ='users.php?change_to_subscriber=$User_ID'>Subscriber</a></td>";
            echo "<td><a href ='users.php?source=edit_users&p_id=$User_ID'>Edit</a></td>";
            echo "<td><a onclick=\"javascript: return confirm('Are your sure you want to delete');\"href ='users.php?delete=$User_ID '>Delete</a></td>";
            
            echo"</tr>";


          }
          
          ?>
          </tbody>
         
           </table>
          <?php 
            if(isset($_GET['change_to_admin'])){


              $admin_user_id = $_GET['change_to_admin'];
              $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$admin_user_id} ";

              $admin_user_query = mysqli_query($connection,$query);
              header("Location: users.php");

  
            if(!$admin_user_query){
            die('QUERY FAILED'. mysqli_error($connection));
             }

             }



              if(isset($_GET['change_to_subscriber'])){


              $subscriber_user_id = $_GET['change_to_subscriber'];
              $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$subscriber_user_id} ";

              $subscriber_user_query = mysqli_query($connection,$query);
              header("Location: users.php");

  
            if(!$subscriber_user_query){
            die('QUERY FAILED'. mysqli_error($connection));
             }

             }


          ?>

           <?php 
            if(isset($_GET['delete'])){
                if(isset($_SESSION['user_role'])){
                  if($_SESSION['user_role']=='admin'){

              $del_user_id = mysqli_real_escape_string($connection,$_GET['delete']);
              $query = "DELETE FROM users WHERE user_id = {$del_user_id} ";

              $delete_user_query = mysqli_query($connection,$query);
             // header("Location: view_all_posts.php");

            header("Location: users.php");
            if(!$delete_user_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }
    }}
    }
          
           ?>



          

          
