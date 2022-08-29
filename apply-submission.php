 <?php include_once('header.php'); // Include Header once

 $jobs_id = $_SESSION['$jobs_id'];

 if (isset($_POST['submit'])) {
     $first_name = mysqli_real_escape_string($db_connect, $_POST['first_name']);
     $last_name = mysqli_real_escape_string($db_connect, $_POST['last_name']);
     $email_address = mysqli_real_escape_string($db_connect, $_POST['email_address']);
     $phone_number = mysqli_real_escape_string($db_connect, $_POST['phone_number']);
     $custom_message = mysqli_real_escape_string($db_connect, $_POST['custom_message']);
     $errors = array();

     if (empty($first_name)) {
         $errors[] = "First name is required";
     }
     if (empty($last_name)) {
         $errors[] = "Last name is required";
     }
     if (empty($email_address)) {
         $errors[] = "Email is required";
     }
    
    // Validate email
     $email_address = filter_var($email_address, FILTER_SANITIZE_EMAIL);
     if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
         $errors[] = "Email is not valid";
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
         $phone_errors = array();
         $phone_errors[] = "Phone number is not valid";
     }

// Check for file validation
     $upload_cv = '';
     if (isset($_FILES['upload_cv'])) {
         $cv_name = $_FILES['upload_cv']['name'];
         $cv_size = $_FILES['upload_cv']['size'];
         $cv_tmp_name = $_FILES['upload_cv']['tmp_name'];
         $cv_error = $_FILES['upload_cv']['error'];

         if ($cv_error === 0) {
             $cv_extenstion = pathinfo($cv_name, PATHINFO_EXTENSION);
             $cv_extenstion_lc = strtolower($cv_extenstion);

             $allowed_exs = array("pdf", "docx");
             if (in_array($cv_extenstion_lc, $allowed_exs)) {
                 $full_cv_name = "cv-".$first_name."-".$last_name;
                 $full_cv_name = preg_replace('/[^A-Za-z0-9\-]/', ' ', $full_cv_name);
                 $cv_new_img_name = str_replace(' ', '-', strtolower($full_cv_name)) . '.' . $cv_extenstion_lc;
                 $cv_upload_path = './cv/' . $cv_new_img_name;
                 $upload_cv  = $cv_new_img_name;
        
                 move_uploaded_file($cv_tmp_name, $cv_upload_path);
             } else {
                 $errors[] = "You can not upload file from this type. Only pdf and docx, please.";
             }
         }
     }
    // Submit without errors
     if (count($errors) == 0) {
         if ($upload_cv !== "") {
             $stmt = $db_connect->prepare("INSERT INTO submissions (first_name, last_name, email, phone, jobs_id, custom_message, cv_name) 
                                    values (?, ?, ?, ?, ?, ?, ?)");
             $stmt->bind_param("sssssss", $first_name, $last_name, $email_address, $phone_number, $jobs_id, $custom_message, $upload_cv);
             $stmt->execute();
         } else {
             $errors[] = "Upload your CV, please";
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
                                <h2 class="heading-title">Submit application to
                                    Company Name</h2>
                            </div>
                            <div><?php require_once('success.php'); ?></div>
                            <?php require_once('errors.php'); //include 'errors.php'; ?>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="flex-container justified-horizontally flex-wrap">                                   
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" name="first_name" value="<?php if (!empty($_SESSION['$user_id'])) {
                                            echo $_SESSION['first_name'];
                                                                                    } ?>" placeholder="First Name*" required/>
                                    </div>
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" name="last_name" value="<?php if (!empty($_SESSION['$user_id'])) {
                                            echo $_SESSION['last_name'];
                                                                                   } ?>" placeholder="Last Name*" required/>
                                    </div>
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" name="email_address" value="<?php if (!empty($_SESSION['$user_id'])) {
                                            echo $_SESSION['email_address'];
                                                                                       } ?>" placeholder="Email*" required/>
                                    </div>
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" name="phone_number" value="<?php if (!empty($_SESSION['$user_id'])) {
                                            echo $_SESSION['phone_number'];
                                                                                      } ?>" placeholder="Phone Number"/>
                                    </div>          
                                    <div class="form-field-wrapper width-large">
                                        <textarea name="custom_message" placeholder="Custom Message*" required></textarea>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                    <label >Upload your CV: </label>
                                        <input type="file" name="upload_cv"/>
                                    </div>
                                </div>  
                                <button type="submit" name="submit" class="button">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); ?>
