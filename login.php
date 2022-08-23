<?php

     include_once('header.php'); // Include Header once
   
    $hashed_password = '';
if (isset($_POST['login_user'])) {
    $errors = array();
    $email_address = mysqli_real_escape_string($db_connect, $_POST['email_address']);
    $user_password = mysqli_real_escape_string($db_connect, $_POST['user_password']);
    
    if (empty($email_address)) {
         $errors[] = 'Email address is required';
    }

    if (empty($user_password)) {
        $errors[] = 'Password is required';
    }

    if (count($errors) == 0) {
        $query = "SELECT user_password FROM users WHERE email = '$email_address'";
    
        $results = mysqli_query($db_connect, $query);
        
        $matches = mysqli_num_rows($results);
        if (0 !== $matches) {
            $row = $results->fetch_row();
                $hashed_password = $row[0];
        }
            
        if (password_verify($_POST['user_password'], $hashed_password)) {
            header('location: index.php');
        } else {
            $errors[] = "Wrong username or password. Please try again.";
        }

          $query_id = "SELECT id FROM users WHERE email = '$email_address'";
    
          $results_id = mysqli_query($db_connect, $query_id);
 
          $matches_id = mysqli_num_rows($results_id);

        if (0 !== $matches_id) {
            $row_id = $results_id->fetch_row();
            $user_id = $row_id[0];
            $_SESSION['$user_id'] = $user_id;

            // Select data for My Profile input values
            $query_profile = "SELECT first_name, last_name, email, phone, company_name, company_site, company_description, company_image, user_password, is_company
            FROM users WHERE id = $user_id";

             $results_profile = mysqli_query($db_connect, $query_profile);
 
             $matches_profile = $results_profile->fetch_all()[0];
            
             $_SESSION['first_name'] = $matches_profile[0];
             $_SESSION['last_name'] = $matches_profile[1];
             $_SESSION['email_address'] = $matches_profile[2];
             $_SESSION['phone_number'] = $matches_profile[3];
             $_SESSION['company_name'] = $matches_profile[4];
             $_SESSION['company_site'] = $matches_profile[5];
             $_SESSION['company_description'] = $matches_profile[6];
             $_SESSION['company_image'] = $matches_profile[7];
             $_SESSION['user_password'] = $matches_profile[8];
             $_SESSION['is_company'] = $matches_profile[9];
            header('location: index.php');
        }
    }
}

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
                                <input type="text" name="email_address" id="email_address" placeholder="Email"/>
                                </div>
                                <div class="form-field-wrapper">
                                <input type="password" name="user_password" id="password" placeholder="Password"/>
                                </div>
                                <button type="submit" name="login_user" class="button">
                                    Login
                                </button>
                            </form>
                            <a href="#" class="button button-inline">Forgot Password</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include_once('footer.php'); ?>
