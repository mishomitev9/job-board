<?php
 require_once('db-connect.php');

if (isset($_POST['reg_user'])) {
   // initializing variables
    $first_name = mysqli_real_escape_string($db_connect, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db_connect, $_POST['last_name']);
    $email_address = mysqli_real_escape_string($db_connect, $_POST['email_address']);
    $password = mysqli_real_escape_string($db_connect, $_POST['password']);
    $password_rep = mysqli_real_escape_string($db_connect, $_POST['password_rep']);
    $phone_number = mysqli_real_escape_string($db_connect, $_POST['phone_number']);
    $company_name = mysqli_real_escape_string($db_connect, $_POST['company_name']);
    $company_site = mysqli_real_escape_string($db_connect, $_POST['company_site']);
    $company_description = mysqli_real_escape_string($db_connect, $_POST['company_description']);
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['email_address'] = $_POST['email_address'];
    $_SESSION['phone_number'] = $_POST['phone_number'];
    $_SESSION['company_name'] = $_POST['company_name'];
    $_SESSION['company_site'] = $_POST['company_site'];
    $_SESSION['company_description'] = $_POST['company_description'];
    
    $errors = array();
    $is_company = !empty($company_name) ? 1 : 0;
    
    // Validation
    if (empty($first_name)) {
        $errors[] = "First name is required";
    }
    if (empty($last_name)) {
        $errors[] = "Last name is required";
    }
    if (empty($email_address)) {
        $errors[] = "Email is required";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    if ($password !== $password_rep) {
        $errors[] = "Passwords do not match";
    }
    
    // Validate if email is admin or not
    $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
    if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $email_pattern = '/@devrix.com/';
        $is_admin = preg_match($email_pattern, $email_address) ? 1 : 0;
    } else {
        $errors[] = "Email is not valid";
    }
    
    // Validate password with 8 characters, at least one special character, at least one capital, and at least one small letter.
      $password_uppercase = preg_match('@[A-Z]@', $password);
      $password_lowercase = preg_match('@[a-z]@', $password);
      $password_special_chars = preg_match('@[^\w]@', $password);
      
    if (!$password_uppercase || !$password_lowercase || !$password_special_chars || strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters, at least one special character, at least one capital letter, and at least one small letter.';
    }
    
    // Validate phone number
      $phone_plus = '/359([0-9]*)/';
      $phone_zero = '/^[0]([0-9]*)/';
      $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
    if (preg_match($phone_plus, $phone_number) && strlen($phone_number) == 12) {
        $phone_number = "+" . $phone_number;
    } elseif (preg_match($phone_zero, $phone_number) && strlen($phone_number) == 10) {
        $phone_number = ltrim($phone_number, '0');
        $phone_number = "+359" . $phone_number;
    } else {
        $errors[] = "Phone number is not valid";
    }
    
    // Validation for empty URL
    if (!empty($company_site)) {
        if (!filter_var($company_site, FILTER_VALIDATE_URL)) {
            $errors[] = "Company site URL is not valid";
        }
    }
    
    // check for existing email
    $email_check_query = "SELECT * FROM users WHERE email = '$email_address'";
    $email_results = mysqli_query($db_connect, $email_check_query);
    $checked_email_address = mysqli_fetch_assoc($email_results);
    
    if ($checked_email_address) {
        if ($checked_email_address["email"] === $email_address) {
            $errors[] = "Email address already exists";
        }
    }
    
    // Check for file validation
    $company_image = '';
    if (!empty($_FILES['upload_logo']) && !empty($company_name) && $is_company == true) {
        $logo_name = $_FILES['upload_logo']['name'];
        $logo_size = $_FILES['upload_logo']['size'];
        $logo_tmp_name = $_FILES['upload_logo']['tmp_name'];
        $logo_error = $_FILES['upload_logo']['error'];
    
        if ($logo_error === 0) {
            $logo_extenstion = pathinfo($logo_name, PATHINFO_EXTENSION);
            $logo_extenstion_lc = strtolower($logo_extenstion);
    
            $allowed_exs = array("jpg", "jpeg", "png");
            if (in_array($logo_extenstion_lc, $allowed_exs)) {
                $company_name = preg_replace('/[^A-Za-z0-9\-]/', ' ', $company_name);
                $logo_new_img_name = str_replace(' ', '-', strtolower($company_name)) . '.' . $logo_extenstion_lc;
                $logo_upload_path = './uploads/' . $logo_new_img_name;
                $company_image  = $logo_new_img_name;
            
                move_uploaded_file($logo_tmp_name, $logo_upload_path);
            } else {
                $errors[] = "You can not upload file from this type";
            }
        }
    } elseif ((!empty($company_name) || !empty($company_description) || !empty($logo_name)) && !((!empty($company_name) && !empty($company_description) && !empty($logo_name)))) {
        $errors[] = "Please fill all company fields!";
    }

    // Check for filled company name
    // if (isset($company_description)) {
    //     $errors[] = "You need to fill Company name first and than you can add company description";
    // }
    
    // Resgister user without errors
    if (count($errors) == 0) {
        $password_encryption = password_hash($password, PASSWORD_DEFAULT); // Encryption the password with password_hash
        $query = "INSERT INTO users (first_name, last_name, email, user_password, phone, is_admin, company_name, company_site, company_description, company_image, is_company) 
		  VALUES ('$first_name', '$last_name', '$email_address', '$password_encryption', '$phone_number', '$is_admin', '$company_name', '$company_site', '$company_description', '$company_image', '$is_company')";
    
        mysqli_query($db_connect, $query);

        // Log the user and make a session for the current user
        $user_id = mysqli_insert_id($db_connect);
        $_SESSION['$user_id'] = $user_id;
        header('location: index.php');
        die;
    }
}

?>
        <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">Register</h2>
                            </div>
                            
                            <div><?php require_once('success.php'); ?></div>
                            <?php require_once('errors.php'); //include 'errors.php'; ?>

                            <form method="post" action="register.php" enctype="multipart/form-data">
                                <div class="flex-container justified-horizontally">
                                    <div class="primary-container">
                                        <h4 class="form-title">About me</h4>
                                        <div class="form-field-wrapper">
                                            
                                            <input type="text" name="first_name" placeholder="First Name*"
                                            <?php if (!empty($_SESSION['first_name'])) {
                                                echo 'value = "'. $_SESSION['first_name'].'" ';
                                            }
                                            ?>" required/>

                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="last_name" placeholder="Last Name*"
                                            <?php if (!empty($_SESSION['last_name'])) {
                                                echo 'value = "'. $_SESSION['last_name'].'" ';
                                            }
                                            ?>" required/>

                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="email_address" placeholder="Email*"
                                            <?php if (!empty($_SESSION['email_address'])) {
                                                echo 'value = "'. $_SESSION['email_address'].'" ';
                                            }
                                            ?>" required/>

                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="password" name="password" placeholder="Password*" required/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="password" name="password_rep" placeholder="Repeat Password*" required/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="phone_number" placeholder="Phone Number*"
                                            <?php if (!empty($_SESSION['phone_number'])) {
                                                echo 'value = "'. $_SESSION['phone_number'].'" ';
                                            }
                                            ?>" required/>
                                            
                                        </div>
                                    </div>
                                    <div class="secondary-container">
                                        <h4 class="form-title">My Company</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_name" placeholder="Company Name"
                                            <?php if (!empty($_SESSION['company_name'])) {
                                                echo 'value = "'. $_SESSION['company_name'].'" ';
                                            }
                                            ?>" />

                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_site" placeholder="Company Site"
                                            <?php if (!empty($_SESSION['company_site'])) {
                                                echo 'value = "'. $_SESSION['company_site'].'" ';
                                            }
                                            ?>" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <textarea name="company_description" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-field-wrapper width-large">
                                            <label class = "label-upload-logo" > Upload company logo:</label>
                                        <input type="file" name="upload_logo"/>
                                    </div>
                                    </div>      
                                </div>                  
                                <button type="sumbit" name="reg_user" class="button">Register</button>
                            </form>
                            
                        </div>
                    </div>
