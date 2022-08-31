 <?php include_once('header.php'); // Include Header once

    // Submissions Query
    $query_submissions = "SELECT id, jobs_id, first_name, last_name, email, phone, custom_message, cv_name
    FROM submissions WHERE id = '{$_SESSION['submission_id']}'";
    $submission_results = mysqli_query($db_connect, $query_submissions);
    $result_matches = $submission_results->fetch_all()[0];
    $jobs_id = $result_matches[1];
    $applicant_name = ($result_matches[2]." ".$result_matches[3]);
    $applicant_email = $result_matches[4];
    $applicant_phone = $result_matches[5];
    $applicant_msg = $result_matches[6];
    $applicant_cv = $result_matches[7];

    // Jobs Query
    $query_jobs =
    "SELECT title
    FROM jobs
    WHERE id='{$jobs_id}'";
    $job_results = mysqli_query($db_connect, $query_jobs);
    $job_num = mysqli_num_rows($job_results);
    $job_match = $job_results->fetch_assoc();
    ?>

        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">   
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h3 class="heading-title"><?php echo $job_match['title']." - ".$applicant_name; ?></h3>
                            </div>
                            <form action="<?php echo CV_URL.$applicant_cv; ?>">
                                <div class="flex-container justified-horizontally flex-wrap">
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" value="<?php echo $applicant_email; ?>" placeholder="Email" readonly />
                                    </div>
                                    <div class="form-field-wrapper width-medium">
                                        <input type="text" value="<?php if (!empty($applicant_phone)) {
                                                                  } echo $applicant_phone; ?>" placeholder="Phone Number" readonly />
                                    </div>          
                                    <div class="form-field-wrapper width-large">
                                        <textarea placeholder="Custom Message" readonly ><?php echo $applicant_msg; ?></textarea>
                                    </div>
                                </div>  
                                <button type="submit" class="button">
                                    Download CV
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); // include Footer once ?> 
    </div>
</body>
</html>
