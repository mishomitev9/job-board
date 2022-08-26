 <?php include_once('header.php'); // Include Header once
 
    // Get the data to set values in the HTML form
     $query_profile = "SELECT first_name, last_name, email,
     phone, company_name, company_site, company_description,
     company_image, user_password, is_company
     FROM users WHERE id =?";

    $stmt = $db_connect->prepare($query_profile);
    $stmt->bind_param("i", $_SESSION['$user_id']);
    $stmt->execute();
    $result_profile = $stmt->get_result();
    $result_profile = $result_profile->fetch_assoc();

 if ($result_profile != false) {
     $first_name          = $result_profile["first_name"];
     $last_name           = $result_profile["last_name"];
     $email_address       = $result_profile["email"];
     $phone_number        = $result_profile["phone"];
     $company_name        = $result_profile["company_name"];
     $company_site        = $result_profile["company_site"];
     $company_description = $result_profile["company_description"];
     $company_image       = $result_profile["company_image"];
     $user_password       = $result_profile["user_password"];
     $is_company          = $result_profile["is_company"];
 }

 if (isset($_POST['update'])) {
     $first_name = mysqli_real_escape_string($db_connect, $_POST['first_name']);
     $last_name = mysqli_real_escape_string($db_connect, $_POST['last_name']);
     $email_address = mysqli_real_escape_string($db_connect, $_POST['email_address']);
     $password = mysqli_real_escape_string($db_connect, $_POST['password']);
     $password_rep = mysqli_real_escape_string($db_connect, $_POST['password_rep']);
     $phone_number = mysqli_real_escape_string($db_connect, $_POST['phone_number']);
     $company_name = mysqli_real_escape_string($db_connect, $_POST['company_name']);
     $company_site = mysqli_real_escape_string($db_connect, $_POST['company_site']);
     $company_description = mysqli_real_escape_string($db_connect, $_POST['company_description']);

     $errors = array();

     // Validate if email is admin or not
     $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
     if (filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
         $email_pattern = '/@devrix.com/';
         $is_admin = preg_match($email_pattern, $email_address) ? 1 : 0;
     } else {
         $errors[] = "Email is not valid";
     }

     // Validate password with 8 characters, at least one special character, at least one capital, and at least one small letter.
     $password_uppercase     = preg_match('@[A-Z]@', $password);
     $password_lowercase     = preg_match('@[a-z]@', $password);
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
        
     // Validation for website
     if (!empty($company_site)) {
         if (!filter_var($company_site, FILTER_VALIDATE_URL)) {
             $errors[] = "Company site URL is not valid";
         }
     }
     if (isset($_FILES['upload_logo']) && isset($company_name) && isset($company_description)) {
         // Image validation
         $company_image = '';
         $logo_name     = $_FILES['upload_logo']['name'];
         $logo_tmp_name = $_FILES['upload_logo']['tmp_name'];
         $logo_error    = $_FILES['upload_logo']['error'];
    
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
     } elseif ((isset($company_name) || isset($company_description) || isset($logo_name))) {
         $errors[] = "Please fill all company fields!";
     }

     // Update data only without errors
     if (count($errors) == 0) {
         $password_encryption = password_hash($password, PASSWORD_DEFAULT); // Encryption the password with password_hash
        
         if ($is_company) {
                $query = "UPDATE users SET 
                first_name =          '$first_name',
                last_name =           '$last_name',
                email =               '$email_address',
                user_password =       '$password_encryption',
                phone =               '$phone_number',
                is_admin =            '$is_admin',
                company_name =        '$company_name',
                company_site =        '$company_site',
                company_description = '$company_description',
                company_image =        '$company_image' 
                WHERE id =?";
         } else {
             $query = "UPDATE users SET 
            first_name =          '$first_name',
            last_name =           '$last_name',
            email =               '$email_address',
            user_password =       '$password_encryption',
            phone =               '$phone_number',
            is_admin =            '$is_admin',
            WHERE id =?";
         }
            $stmt1 = $db_connect->prepare($query);
            $stmt1->bind_param("i", $_SESSION['$user_id']);
            $stmt1->execute();
            $result_profile_update = $stmt1->get_result();

         if ($result_profile_update != false) {
             echo "Updated successfully";
         
                $query_updated = "SELECT first_name, last_name, email, phone, company_name,
                company_site, company_description, company_image, user_password 
                FROM users WHERE id =?";
    
                $stmt2 = $db_connect->prepare($query_updated);
                $stmt2->bind_param("i", $_SESSION['$user_id']);
                $stmt2->execute();
                $result_profile_updated = $stmt2->get_result();
                $result_profile_updated = $result_profile_updated->fetch_assoc();

             if ($result_profile_updated != false) {
                 $first_name          = $result_profile_updated["first_name"];
                 $last_name           = $result_profile_updated["last_name"];
                 $email_address       = $result_profile_updated["email"];
                 $phone_number        = $result_profile_updated["phone"];
                 $company_name        = $result_profile_updated["company_name"];
                 $company_site        = $result_profile_updated["company_site"];
                 $company_description = $result_profile_updated["company_description"];
                 $company_image       = $result_profile_updated["company_image"];
                 $user_password       = $result_profile_updated["user_password"];
                 $is_company          = $result_profile_updated["is_company"];
             }
         }
     }
 }
    ?>

        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">   
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">My Profile</h2>
                            </div>
                            <div><?php require_once('success.php'); ?></div>
                            <?php require_once('errors.php'); //include 'errors.php'; ?>

                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="flex-container justified-horizontally">
                                    <div class="primary-container">
                                        <h4 class="form-title">About me</h4>
                                        <div class="form-field-wrapper">
                
                                            <input type="text" name="first_name" value="<?php echo $first_name; ?>">

                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="email_address" value="<?php echo $email_address; ?>" placeholder="Email*"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="password" name="password" value="<?php echo $user_password; ?>" placeholder="Password"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="password" name="password_rep" value="<?php echo $user_password; ?>" placeholder="Repeat Password"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="phone_number" value="<?php echo $phone_number; ?>" placeholder="Phone Number"/>
                                        </div>
                                    </div>
                                    <div class="secondary-container">
                                        <h4 class="form-title">My Company</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_name" value="<?php echo $company_name; ?>" placeholder="Company Name"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_site" value="<?php echo $company_site; ?>" placeholder="Company Site"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <textarea name="company_description" placeholder="Description"><?php echo $company_description; ?></textarea>
                                        </div>
                                        <div class="form-field-wrapper width-large">
                                                    <label class = "label-upload-logo" > Upload new company logo:</label>
                                                <input type="file" name="upload_logo"/>
                                            </div>                 
                                    </div>      
                                </div> 
                                <button type="submit" class="button" name="update" >
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>
