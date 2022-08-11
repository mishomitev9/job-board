<?php

     include_once('header.php'); // Include Header once
     
if (isset($_POST['login_user'])) {
    $errors = array();
    $first_name = '';
    $email_address = mysqli_real_escape_string($db_connect, $_POST['email_address']);
    $user_password = mysqli_real_escape_string($db_connect, $_POST['user_password']);
    
    if (empty($email_address)) {
          array_push($errors, 'Email address is required');
    }
    if (empty($user_password)) {
        array_push($errors, 'Password is required');
    }
    if (count($errors) == 0) {
        $user_password = md5($user_password);
    
        $query = "SELECT * FROM users WHERE email = '$email_address' AND user_password = '$user_password'";
    
    
        $results = mysqli_query($db_connect, $query);
         
        $matches = mysqli_num_rows($results);
        if (0 !== $matches) {
            while ($row = $results->fetch_row()) {
                 //var_dump($row);
                 $first_name = $row[1];
            }
        }
    
        if (mysqli_num_rows($results)) {
            $_SESSION['email'] = $email_address;
            $_SESSION['success'] = "Logged in successfully $first_name";
            echo "$first_name logged in .";
            $_SESSION['login'] = 1;
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username or password. Please try again.");
        }
    }
}
    
?>
    
?>
        <main class="site-main">
            <section class="section-fullwidth section-login">
                <div class="row">
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">Login</h2>
                                <?php require_once('errors.php'); ?>
                            </div>
                            <form action="login.php" method="post">
                                <div class="form-field-wrapper">
                                <input type="text" name="email" id="email_address" placeholder="Email"/>
                                </div>
                                <div class="form-field-wrapper">
                                <input type="password" name="user_password" id="password" placeholder="Password"/>
                                </div>
                                <button type="submit" class="button">
                                    Login
                                </button>
                            </form>
                            <a href="#" class="button button-inline">Forgot Password</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include_once('footer.php');
