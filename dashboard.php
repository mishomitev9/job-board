<?php
include_once('header.php');
include_once('functions.php');

 // Make sure user is logged in
if (!$_SESSION['logged_in']) {
    header('Location: '."login.php");
}

if ($_SESSION['is_admin'] & isset($_POST['action']) & isset($_POST['id'])) { //this code is executed when the form is submitted
    $action = ($_POST['action'] == 'approve')?1:0;
    $query_approve   = "UPDATE jobs 
                        SET is_approved = '{$action}'
                        WHERE id='{$_POST["id"]}'";
    $approve_results = mysqli_query($db_connect, $query_approve);
}
?> 

<main class="site-main">
    <section class="section-fullwidth section-jobs-dashboard">
        <div class="row">
            <div class="jobs-dashboard-header flex-container centered-vertically justified-horizontally">
                <div class="primary-container">                         
                    <ul class="tabs-menu">
                        <li class="menu-item current-menu-item">
                            <a href="#">Jobs</a>                    
                        </li>
                        <li class="menu-item">
                            <a href="#">Categories</a>
                        </li>
                    </ul>
                </div>
                <div class="secondary-container">
                    <div class="flex-container centered-vertically">
                        <div class="search-form-wrapper">
                            <div class="search-form-field"> 
                                <input class="search-form-input" type="text" value="" placeholder="Search…" name="search" > 
                            </div> 
                        </div>
                        <div class="filter-wrapper">
                            <div class="filter-field-wrapper">
                                <select>
                                    <option value="1">Date</option>
                                    <option value="2">Date</option>
                                    <option value="3">Date</option>
                                    <option value="4">Type</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="action_msg">
                <?php
                if (isset($_POST['action']) & isset($_POST['id'])) { //this code is executed when the form is submitted
                    ?> 

                        <strong>Job <b><?php echo $_POST['title']; ?></b> has been <i><?php echo ($_POST['action'] == "approve")?"Approved":"Rejected"; ?></i></strong>
                        
                        <?php
                } ?>
            </div>
            <ul class="jobs-listing">
            
            <?php
                $cond = ($_SESSION['is_admin'])?"":"WHERE jobs.user_id = {$_SESSION['$user_id']}";
                $sql_jobs = "SELECT jobs.id, jobs.title, jobs.salary, jobs.location, jobs.date_posted, jobs.is_approved, jobs.description,
                users.phone, users.company_name, users.company_site
                FROM jobs 
                LEFT JOIN users ON jobs.user_id = users.id
                $cond
                ORDER BY date_posted";
            $jobs_result = mysqli_query($db_connect, $sql_jobs);
            if (mysqli_num_rows($jobs_result) > 0) {
                // output data for each row
                while ($row = mysqli_fetch_assoc($jobs_result)) {
                    $posted_date = date($row["date_posted"]);
                    $posted_date = date_create($posted_date);
                    ?>
                    <li class="job-card">
                        <div class="job-primary">
                        <h2 class="job-title"><a href="single.php?job_id=<?php echo $row["id"]; ?>" ><?php echo $row["title"]; ?></a></h2>
                            <div class="job-meta">
                                <a class="meta-company" href="<?php echo $row["company_site"]; ?>"><?php echo $row["company_name"]; ?></a>
                                <span class="meta-date">Posted <?php echo time_message($posted_date); ?></span>
                            </div>
                            <div class="job-details">
                                <span class="job-location"><?php echo $row["location"]; ?></span>
                                <span class="job-type"><?php echo $row["phone"]; ?></span>
                            </div>
                        </div>
                        <div class="job-secondary">
                        <?php if ($_SESSION['is_admin']) {?>
                            <div class="job-actions">
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type='hidden' name='id' value='<?php echo $row["id"]; ?>'/>
                                    <input type='hidden' name='title' value='<?php echo $row["title"]; ?>'/>
                                    <button type= "text" name="action" value="approve">Approve</button>
                                    <button type= "text" name="action" value="reject">Reject</button>
                                </form>
                            </div>
                        <?php } ?>
                            <div class="job-edit">
                                <a href="submissions.php?job_id=<?php echo $row["id"]; ?>">View Submissions</a>
                                <a href="actions-job.php?job_id=<?php echo $row["id"]; ?>"" >Edit</a>
                            </div>
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
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
