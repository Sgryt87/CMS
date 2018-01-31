<?php include 'includes/admin_header.php'; ?>

<?php

?>
    <div id="wrapper">


    <!-- Navigation -->
    <?php include 'includes/admin_navigation.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to admin
                        <small><?php echo escape($_SESSION['username']); ?></small>
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
                                    <div class='huge'><?php echo $post_counts = recordCount('posts')?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
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
                                    <div class='huge'><?php echo $comments_counts = recordCount('comments')?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
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
                                     <div class='huge'><?php echo $users_counts = recordCount('users')?></div>
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
                                    <div class='huge'><?php echo $categories_counts = recordCount('categories')?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
//            $query = "SELECT * FROM posts WHERE post_status = 'published'";
//            $select_all_published_post = mysqli_query($connection, $query);
            $post_published_counts = checkStatus('posts', 'post_status', 'published');

//            $query = "SELECT * FROM posts WHERE post_status = 'draft'";
//            $select_all_draft_post = mysqli_query($connection, $query);
            $post_draft_counts = checkStatus('posts', 'post_status', 'draft');

//            $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
//            $unapproved_comments_query = mysqli_query($connection, $query);
            $unapproved_comments_counts = checkStatus('comments', 'comment_status', 'unapproved');

//            $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
//            $select_all_subscribers = mysqli_query($connection, $query);
            $subscriber_counts = checkStatus('users', 'user_role', 'subscriber');
            ?>
            <!--charts-->
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages': ['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php

                            $elements_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers Count', 'Categories'];
                            $elements_count = [$post_counts, $post_published_counts, $post_draft_counts, $comments_counts, $unapproved_comments_counts, $users_counts, $subscriber_counts, $categories_counts];

                            $arr_length = count($elements_count);
                            for ($i = 0; $i < $arr_length; $i++) {
                                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
                            }
                            ?>
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: ''
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
    <!-- /#page-wrapper -->


<?php include 'includes/admin_footer.php'; ?>