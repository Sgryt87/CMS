<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <!--                Dynamic categories pulled from a DB-->
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    $cat_class = '';
                    $reg_class = '';
                    $cont_class = '';
                    $current_page = basename($_SERVER['PHP_SELF']);
                    $reg_page = 'registration.php';
                    $cont_page = 'contact.php';

                    if (isset($_GET['category']) && $_GET['category'] === $cat_id) {
                        $cat_class = 'active_class';
                    } else if ($current_page === $reg_page) {
                        $reg_class = 'active_class';
                    }else if ($current_page === $cont_page) {
                        $cont_class = 'active_class';
                    }

                    echo "<li><a href='category.php?category={$cat_id}' class='$cat_class'>{$cat_title}</a></li>";
                }
                ?>
                <li>
                    <a href="admin">Admin</a>
                </li>
                <li>
                    <a href="registration.php" class="<?php echo $reg_class;?>">Registration</a>
                </li>
                <li>
                    <a href="contact.php" class="<?php echo $cont_class;?>">Contact</a>
                </li>

                <?php
                if (isset($_SESSION['user_role'])) {
                    if (isset($_GET['p_id'])) {
                        $the_post_id = escape($_GET['p_id']);
                        echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                    }
                }
                ?>


            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>