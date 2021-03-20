<?php include "includes/admin_header.php";?>

    <div id="wrapper">
    <?php

    
    ?>


    <?php if($connection) echo "conn";?>
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                           
                            <small> <?php echo $_SESSION['username'] ?></small>
                        </h1>
                   
                    </div>
                </div>
                <!-- /.row -->


                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                <?php 
                $post_count= record_count('posts');
                echo "<div class='huge'>{$post_count}</div>"
                ?>
                
                  
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                        $comment_count = record_count('comments');
                        echo "<div class='huge'>{$comment_count}</div>"
                ?>
                     
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comment.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php 
                        $users_count = record_count('users');
                        echo "<div class='huge'>{$users_count}</div>"
                ?>
                   
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php 
                        $categories_count = record_count('categories');
                        echo "<div class='huge'>{$categories_count}</div>"
                ?> 
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="category.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<?php 
 


$post_draft_count = status_check('posts','post_status','draft');


$post_published_count = status_check('posts','post_status','published');

$users_subscriber_count = status_check('users','user_role','subscriber');


$comment_approved_count = status_check('comments','comment_status','Approved');



?>



                <!-- /.row -->
                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
         ['Data', 'Count'],
         <?php 
            
            $element_text = ['All Posts','Active Posts','Draft Posts','Comments','Approved comment','Users','Subscribed User','categories'];
            $element_count = [$post_count,$post_published_count, $post_draft_count,$comment_count,$comment_approved_count,$users_count,$users_subscriber_count,$categories_count];

            for($i=0; $i< 8; $i++){
                echo"['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

            }
            
        ?>


         
        //   ['post_count', 1000 ]
         
        ]);

        var options = {
          chart: {
            
            
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <div id="columnchart_material" style="width: auto; height: 500px;"></div>




                </div>

    </div>
            <!-- /.container-fluid -->

        </div>
        <?php include "includes/admin_footer.php";?>
