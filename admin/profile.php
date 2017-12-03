<?php include 'includes/admin_header.php'; ?>

<?php
if (isset($_SESSION['username'])) {
    $username = escape($_SESSION['username']);

    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_profile_query = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

}

?>

<?php
if (isset($_POST['edit_user'])) {

    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = escape($_POST['user_role']);

//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];

    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
//    $post_date = date('d-m-y');


//    move_uploaded_file($post_image_temp, "../images/$post_image");
//
//
    $query = "UPDATE users SET
          user_firstname ='{$user_firstname}',
          user_lastname = '{$user_lastname}',
          user_role = '{$user_role}',
          username = '{$username}',
          user_email = '{$user_email}',
          user_password = '{$user_password}'
          WHERE username= '{$username}'";

//if (empty($post_image)) {
//    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
//    $select_post_image = mysqli_query($connection, $query);
//    confirmQuery($select_post_image);
    $edit_user_query = mysqli_query($connection, $query);
    confirmQuery($edit_user_queryy);
}
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
                        <small>Author</small>
                    </h1>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="author">First Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_firstname; ?>"
                                   name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="post_status">Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $user_lastname; ?>"
                                   name="user_lastname">
                        </div>

                        <div class="form-group">
                            <select name="user_role" id="">
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php
                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>subscriber</option>";
                                } else {
                                    echo "<option value='admin'>admin</option>";
                                }
                                ?>


                            </select>
                        </div>

                        <!---->
                        <!--    <div class="form-group">-->
                        <!--        <label for="post_image">Post Image</label>-->
                        <!--        <input type="file" class="form-control" name="image">-->
                        <!--    </div>-->

                        <div class="form-group">
                            <label for="post_tags">User Name</label>
                            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" class="form-control" value="<?php echo $user_email; ?>"
                                   name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" class="form-control" value="<?php echo $user_password; ?>"
                                   name="user_password">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include 'includes/admin_footer.php'; ?>
