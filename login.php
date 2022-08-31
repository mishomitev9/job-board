<?php include_once('header.php'); // Include Header once
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
            $query = "SELECT user_password FROM users WHERE email =?";
            $stmt = $db_connect->prepare($query);
            $stmt->bind_param("s", $email_address);
            $stmt->execute();
            $result_password = $stmt->get_result(); // get the result

        if ($result_password != false) {
            $matches_pass = $result_password->fetch_assoc(); // fetch data
            if (($matches_pass) > 0) {
                $hashed_password = $matches_pass["user_password"];
            }
        }
        if (password_verify($_POST['user_password'], $hashed_password)) {
            header('location: index.php');
        } else {
            $errors[] = "Wrong username or password. Please try again.";
        }
        
            // SQL with parameters
            $query_id = "SELECT id FROM users WHERE email =?";
            $stmt1 = $db_connect->prepare($query_id);
            $stmt1->bind_param("s", $email_address);
            $stmt1->execute();
            $result = $stmt1->get_result(); // get the mysqli result
            
        if ($result != false) {
            $matches_id = $result->fetch_assoc(); // fetch data
            if (($matches_id) > 0) {
                $user_id = $matches_id['id'];
                $_SESSION['$user_id'] = $user_id;
            }

       // Select data for My Profile input values
            $query_profile = "SELECT first_name, last_name, email,
                     phone, company_name, company_site, company_description,
                     company_image, user_password, is_company, is_admin
                     FROM users WHERE id =?";

            $stmt2 = $db_connect->prepare($query_profile);
            $stmt2->bind_param("i", $_SESSION['$user_id']);
            $stmt2->execute();
            $result_profile = $stmt2->get_result();
            $result_profile = $result_profile->fetch_assoc();

            if ($result_profile != false) {
                $_SESSION['first_name']          = $result_profile["first_name"];
                $_SESSION['last_name']           = $result_profile["last_name"];
                $_SESSION['email_address']       = $result_profile["email"];
                $_SESSION['phone_number']        = $result_profile["phone"];
                $_SESSION['company_name']        = $result_profile["company_name"];
                $_SESSION['company_site']        = $result_profile["company_site"];
                $_SESSION['company_description'] = $result_profile["company_description"];
                $_SESSION['company_image']       = $result_profile["company_image"];
                $_SESSION['user_password']       = $result_profile["user_password"];
                $_SESSION['is_company']          = $result_profile["is_company"];
                $_SESSION['is_admin']            = $result_profile["is_admin"];

                        
                header('location: index.php');
            }
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
                                <button type="submit" name="login_user" class="button">Login</button>
                        </form>
                                <a href="#" class="button button-inline">Forgot Password</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

<?php include_once('footer.php'); ?>
