<?php 

function redirect($location){
  return header("Location:".$location);
  exit;
}

function confirmQuery($result) {
    
    global $connection;

    if(!$result ) {
          
          die("QUERY FAILED ." . mysqli_error($connection));
   
          
      }
    

}
function query($query){
global $connection;
return mysqli_query($connection,$query);

}

function email_exists($email){

    global $connection;


    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);

    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }



}


function ifItIsMethod($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;

    }

    return false;

}

function isLoggedIn(){

    if(isset($_SESSION['user_role'])){

        return true;

    }

   return false;

}

function LoggedInUserId(){
  if(isLoggedIn()){
    $result = query("SELECT * FROM users WHERE username ='".$_SESSION['username']."'");
    confirmQuery($result);
    $user = mysqli_fetch_array($result);
    
    if(mysqli_num_rows($result)>=1){
      return $user['user_id'];
    }
  }
  return false;
}


function userLikedthisPost($post_id = ''){
if (LoggedInUserId()!= false){
$result = query("SELECT * FROM likes WHERE user_id = ".LoggedInUserId() ." AND post_id={$post_id}");
confirmQuery($result);
return mysqli_num_rows($result) >=1 ? true: false;
}

}

function getPostlikes($post_id){
  $result= query("SELECT * FROM likes WHERE post_id = {$post_id}");
  echo mysqli_num_rows($result);
}




function checkIfUserIsLoggedInAndRedirect($redirectLocation){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}


function escape($string){
  global $connection;

  return myqli_real_escape_string($connection, trim($string));
}

 function user_login(){
     global $connection;

      $session = session_id();
     $time = time();
     $time_out_session = 60;
     $time_out = $time - $time_out_session;
     $query = "SELECT * from users_login WHERE user_session = '$session'";
     $user_login_session = mysqli_query($connection, $query);
     $count =  mysqli_num_rows($user_login_session);
     if($count == NULL){
         $session_inserted = mysqli_query($connection, "INSERT INTO users_login(user_session, user_time) VALUES('$session', '$time')");
        
     }else{
         $session_update = mysqli_query($connection, "UPDATE users_login SET  user_time = '$time_out' where user_session = '$session'");
     }


    $session_online_count = mysqli_query($connection, "SELECT * FROM users_login where user_time > '$time_out' ");

   return $count_users = mysqli_num_rows($session_online_count);
 }

function insert_categories(){
  global $connection;

 if(isset($_POST['submit'])){
               //echo"<h1>HELLO</h1>";
  $cat_Title = $_POST['cat_title']; 

  if($cat_Title == "" || empty($cat_Title)){
  echo "This field should not be empty";

  }else{
      $stmt = mysqli_prepare($connection,"INSERT INTO categories(cat_Title) VALUES(?) ");
      mysqli_stmt_bind_param($stmt,'s',$cat_Title);
      mysqli_stmt_execute($stmt);

      

      if(!$stmt){
          die('QUERY FAILED'. mysqli_error($connection));
      }
      mysqli_stmt_close($stmt);
  }
}
}
 function findallcategories(){

   global $connection;
   $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query); 
    while($row = mysqli_fetch_assoc($select_categories)){
    $cat_Id = $row['cat_Id'];
    $cat_Title = $row['cat_Title'];
    echo"<tr>";
    echo "<td>{$cat_Id}</td>";
    echo "<td>{$cat_Title}</td>";
    echo "<td><a href= 'category.php?delete={$cat_Id}'</a>Delete</td>";
    echo "<td><a href= 'category.php?edit={$cat_Id}'</a>Edit</td>";
    echo"</tr>";
  }
 }

function deletecategories(){

    global $connection;
    if(isset($_GET['delete'])){
    $del_cat_id = $_GET['delete'];
    $query = "DELETE FROM categories WHERE cat_Id = {$del_cat_id} ";
    $delete_query = mysqli_query($connection,$query);
    header("Location: category.php");
    
    }
}

function updatecategories(){
   global $connection;

    if(isset($_GET['edit'])){
     $edit_cat_id = $_GET['edit'];
   
    if(isset($_POST['Update'])){
    
    $update_cat_Title = $_POST['cat_title'];
    $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_Id = ? ");
    mysqli_stmt_bind_param($stmt,"si",$update_cat_Title,$edit_cat_id);
    mysqli_stmt_execute($stmt);
    
    if(!$stmt){
        echo"this failed";
        die("QUERY FAILED" . mysqli_error($connection));
        

    }
    header("Location: category.php");
  }
  
  }

}

function record_count($table){
  global $connection;
  $query = "SELECT * FROM $table ";
                $select_all_posts = mysqli_query($connection, $query);
                return $post_count = mysqli_num_rows($select_all_posts);
}

function status_check($table,$column,$selector){
   global $connection;
  $query = "SELECT * FROM $table WHERE $column= '$selector' ";
  $select_all_draft_posts = mysqli_query($connection, $query);
  return $post_draft_count = mysqli_num_rows($select_all_draft_posts);
}

function is_admin($username=''){
        global $connection;
        $query = "SELECT user_role FROM users WHERE username = '$username'";
        $result = mysqli_query($connection,$query);
      while($row = mysqli_fetch_array($result)){
        if($row['user_role']=='admin'){
          return true;

        }else{
          return false;
        }
      }
}

function user_exits($username){
 global $connection;
 $query = " SELECT username FROM users WHERE username = '$username'";
 
 if(mysqli_num_rows(mysqli_query($connection,$query)) > 0){
   return true;

 }else{
   return false;
 }

}
function email_exits($email){
 global $connection;
 $query = " SELECT user_email FROM users WHERE user_email = '$email'";
 //$result = mysqli_query($connection,$query);
 //echo $result;
 if(mysqli_num_rows(mysqli_query($connection,$query)) > 0){
   return true;

 }else{
   return false;
 }

}

function register_user($username, $email, $password)
{
  global $connection;

     $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    $email = mysqli_real_escape_string($connection,$email);

    $password= password_hash($password, PASSWORD_BCRYPT,array('cost'=> 10));
     
 $query = "INSERT INTO users(username, user_password, user_email, user_role) ";

$query .= 
"VALUES('{$username}','{$password}','{$email}','subscriber') ";

$add_reg_user_query = mysqli_query($connection,$query);

      if(!$add_reg_user_query){
          die('QUERY FAILED'. mysqli_error($connection));
      }

    }



function login_user($username, $password){
  global $connection;
  $username = trim($username);
  $password = trim($password);
  $username = mysqli_real_escape_string($connection,$username);
  $password = mysqli_real_escape_string($connection,$password);

  $query = "SELECT * FROM users WHERE username = '{$username}' ";
  $select_user_query = mysqli_query($connection, $query);
  if(!$select_user_query){
    die("QUERY FAILED".mysqli_error($connection));
  }
  
  while($row = mysqli_fetch_assoc($select_user_query)){
       $db_userid = $row['user_id'];
       $db_user_name = $row['username'];
       $db_user_firstname = $row['user_firstname'];
       $db_user_secondname = $row['user_secondname'];
       $db_user_password = $row['user_password'];
       $db_user_role = $row['user_role'];
  }
       
if(password_verify($password,$db_user_password)){
   $_SESSION['userid']= $db_userid;
  $_SESSION['username']= $db_user_name;
  $_SESSION['password']= $db_user_password;
  $_SESSION['firstname']= $db_user_firstname;
  $_SESSION['lastname']= $db_user_secondname;
  $_SESSION['user_role']= $db_user_role;

 header("Location:admin");

} else{
   header("Location:index.php");
}
}
?>