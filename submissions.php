<?php include_once('header.php'); // Include Header once
if (!isset($_GET['job_id'])) {
    header('Location: '."index.php");
}

    $job_id = $_GET['job_id'];
    
    $query_submissions =
    "SELECT jobs_id, first_name, last_name
    FROM submissions
    WHERE jobs_id='{$_GET['job_id']}'";
    $results_profile = mysqli_query($db_connect, $query_submissions);
    $appliciants_num = mysqli_num_rows($results_profile);

    $query_jobs =
    "SELECT id, title
    FROM jobs
    WHERE id='{$_GET['job_id']}'";
    $job_results = mysqli_query($db_connect, $query_jobs);
    $job_num = mysqli_num_rows($job_results);
    $job_match = $job_results->fetch_assoc();
?>
        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">                       
                    <ul class="tabs-menu">
                        <li class="menu-item current-menu-item">
                            <a href="#">Jobs</a>                    
                        </li>
                        <li class="menu-item">
                            <a href="#">Categories</a>
                        </li>
                    </ul>
                    <div class="section-heading">
                        <h2 class="heading-title"><?php echo $job_match['title']; ?> - Submissions - 
                            <?php echo ($appliciants_num > 0) ? $appliciants_num : 0; ?> Appliciants</h2>
                    </div>
                    <ul class="jobs-listing">
                        <?php
                        if ($appliciants_num > 0) {
                            while ($matches_profile = $results_profile->fetch_assoc()) {
                                $full_name = $matches_profile['first_name']." ".$matches_profile['last_name'];
                                ?>
                    <li class="job-card">
                        <div class="job-primary">
                                <h2 class="job-title">
                                <?php echo $full_name;
                                ?>
                                </h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
                            <?php }
                        } ?>
                    </ul>                   
                    <div class="jobs-pagination-wrapper">
                        <div class="nav-links"> 
                            <a class="page-numbers current">1</a> 
                            <a class="page-numbers">2</a> 
                            <a class="page-numbers">3</a> 
                            <a class="page-numbers">4</a> 
                            <a class="page-numbers">5</a> 
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>
