 <?php
 include_once('header.php'); // Include Header once

 // Make sure user is logged in
 if (!$_SESSION['logged_in']) {
     header('Location: '."login.php");
 }

 $job_title = "";
 $job_location = "";
 $job_salary = "";
 $job_description = "";
 $action = "Create";

 if (isset($_POST['new_job'])) {
     $today_date = date("Y/m/d"); // Get today date

     if (isset($_SESSION['is_company'])) { // Check if the key exist in $_SESSION
         if ($_SESSION['is_company'] == true) { // Check if the logged acc is company
          // initializing variables
               $title = mysqli_real_escape_string($db_connect, $_POST['title']);
               $location = mysqli_real_escape_string($db_connect, $_POST['location']);
               $salary = mysqli_real_escape_string($db_connect, $_POST['salary']);
               $description = mysqli_real_escape_string($db_connect, $_POST['description']);
               $errors = array();
    
           // Validation
             if (empty($title)) {
                 $errors[] = "Title is required";
             }
             if (empty($description)) {
                 $errors[] = "Job description is required";
             }
            
             if (count($errors) == 0) {
                 $user_id = $_SESSION['$user_id'];

                 $stmt = $db_connect->prepare("INSERT INTO
                jobs(user_id, title, salary, location, date_posted, description, is_approved)
                VALUES(?, ?, ?, ?, ?, ?, ?)");
                 $is_approved = 0;
                 $stmt->bind_param(
                     "sssssss",
                     $user_id,
                     $title,
                     $salary,
                     $location,
                     $today_date,
                     $description,
                     $is_approved
                 );
                 if ($stmt->execute() === false) {
                     echo "Error: " . $stmt->error;
                 }
             }
         }
     }
 } elseif (isset($_GET['job_id'])) {
     $action = "Edit";

     $job_id = $_GET['job_id'];

     echo "Job id {$job_id}";
     $query_jobs =
     "SELECT id, title, salary, description, location
     FROM jobs
     WHERE id='{$job_id}'";
     $job_results = mysqli_query($db_connect, $query_jobs);
     $job_num = mysqli_num_rows($job_results);
     $job_match = $job_results->fetch_assoc();

     $job_title = $job_match['title'];
     $job_location = $job_match['location'];
     $job_salary = $job_match['salary'];
     $job_description = $job_match['description'];
 }

    ?>
        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">   
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">New job</h2>
                            </div>
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="flex-container flex-wrap">
                                    <div class="form-field-wrapper width-large">
                                        <input type="text" name="title" value="<?php echo $job_title ?>" placeholder="Job title*" required/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <input type="text" name="location" value="<?php echo $job_location ?>" placeholder="Location"/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <input type="number" name="salary" value="<?php echo $job_salary ?>" placeholder="Salary"/>
                                    </div>
                                    <div class="form-field-wrapper width-large">
                                        <textarea name="description" placeholder="Description*" required><?php echo $job_description ?></textarea>
                                    </div>  
                                <button type="submit" name="new_job" class="button">
                                    <?php echo $action ?>
                                </button>
                            </form>
                            <?php require_once('errors.php'); // Include the errors ?>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); // Include Footer once ?>
