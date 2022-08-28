<?php include_once('header.php'); // Include Header once
include_once('functions.php');

?>
        <main class="site-main">
            <section class="section-fullwidth section-jobs-preview">
                <div class="row">  
                    <?php require_once('success.php'); ?>
                        <ul class="tags-list">
                        <li class="list-item">
                            <a href="#" class="list-item-link">Commerce</a>
                        </li>
                        <li class="list-item">
                            <a href="#" class="list-item-link">Architecture</a>
                        </li>
                        <li class="list-item">
                            <a href="#" class="list-item-link">Marketing</a>
                        </li>
                    </ul>
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
                                    <option value="2">Type</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <ul class="jobs-listing">

<?php
$sql_jobs = "SELECT jobs.id, jobs.title, jobs.salary, jobs.location, jobs.date_posted, jobs.description, users.phone, users.company_name, users.company_site, users.company_image FROM jobs 
LEFT JOIN users ON jobs.user_id = users.id ORDER BY date_posted";
$jobs_result = mysqli_query($db_connect, $sql_jobs);
if (mysqli_num_rows($jobs_result) > 0) {
    $img_dir = "./uploads/";

    // output data of each row
    while ($row = mysqli_fetch_assoc($jobs_result)) {
        $posted_date = date($row["date_posted"]);
        $posted_date = date_create($posted_date);
        $image = $img_dir.$row["company_image"];
        
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
                            <div class="job-logo">
                                <div class="job-logo-box">
                                    <img src="<?php echo $image; ?>" />
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
