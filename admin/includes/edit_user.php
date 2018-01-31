<?php

if (isset($_GET['edit_user'])) {
    $the_user_id = escape($_GET['edit_user']);

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_query = mysqli_query($connection, $query);
    if (!$select_users_query) {
        die('Query Failed' . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_users_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }

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

        if (!empty($user_password)) {
            $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);
            confirmQuery($get_user_query);
            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];

            if ($db_user_password != $user_password) {
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
            }

            $query = "UPDATE users SET
          user_firstname ='{$user_firstname}',
          user_lastname = '{$user_lastname}',
          user_role = '{$user_role}',
          username = '{$username}',
          user_email = '{$user_email}',
          user_password = '{$hashed_password}'
          WHERE user_id = {$the_user_id}";

//if (empty($post_image)) {
//    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
//    $select_post_image = mysqli_query($connection, $query);
//    confirmQuery($select_post_image);
            $edit_user_query = mysqli_query($connection, $query);
            confirmQuery($edit_user_query);
            echo "<p class='bg-success'>User Updated " . "<a href='users.php'>View Users</a></p>";
        }
    }
} else {
    header('Location: index.php');
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" value="<?php echo $user_firstname; ?>" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="post_status">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $user_lastname; ?>" name="user_lastname">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
        <input type="email" class="form-control" value="<?php echo $user_email; ?>" name="user_email">
    </div>

    <div class="form-group">
        <label for="post_content">Password</label>
        <input type="password" class="form-control" value="" name="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>

</form>