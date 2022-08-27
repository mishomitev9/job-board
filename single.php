<?php include_once('header.php'); // Include Header once
include_once('functions.php');

$jobs_url_id = $_GET['job_id'];

if ($jobs_url_id != null) {
    $img_dir = "./uploads/";
    $stmt = $db_connect->
    prepare("SELECT *
	FROM jobs 
	LEFT JOIN users ON jobs.user_id=users.id 
	WHERE jobs.id =?");
    $stmt->bind_param("s", $_GET['job_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $posted_date = date($row["date_posted"]);
    $posted_date = date_create($posted_date);
    $image = $img_dir.$row["company_image"];
}
?>
        <main class="site-main">
            <section class="section-fullwidth">
                <div class="row">
                    <div class="job-single">
                        <div class="job-main">
                            <div class="job-card">
                                <div class="job-primary">
                                    <header class="job-header">
                                        <h2 class="job-title"><a href="#"><?php echo $row["title"]; ?></a></h2>
                                        <div class="job-meta">
                                            <a class="meta-company" href="#"><?php echo $row["company_name"]; ?></a>
                                            <span class="meta-date">Posted <?php echo time_message($posted_date); ?></span>
                                        </div>
                                        <div class="job-details">
                                            <span class="job-location"><?php echo $row["location"]; ?></span>
                                            <span class="job-type"><?php echo $row["phone"]; ?></span>
                                            <span class="job-price"><?php echo $row["salary"]."лв."; ?></span>
                                        </div>
                                    </header>

                                    <div class="job-body">
                                    <?php echo nl2br($row["description"]); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <aside class="job-secondary">
                            <div class="job-logo">
                                <div class="job-logo-box">
                                <img src="<?php echo $image; ?>" />
                                </div>
                            </div>
                            <a href="#" class="button button-wide">Apply now</a>
                            <a href="<?php echo $row["company_site"]; ?>">
                            <?php echo $row["company_site"]; ?>
                        </a>
                        </aside>
                    </div>
                </div>
            </section>
            <section class="section-fullwidth">
                <div class="row">
                    <h2 class="section-heading">Other related jobs:</h2>
                    <ul class="jobs-listing">
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title"><a href="#">Front End Developer</a></h2>
                                <div class="job-meta">
                                    <a class="meta-company" href="#">Company Awesome Ltd.</a>
                                    <span class="meta-date">Posted 14 days ago</span>
                                </div>
                                <div class="job-details">
                                    <span class="job-location">The Hague (The Netherlands)</span>
                                    <span class="job-type">Contract staff</span>
                                </div>
                            </div>
                            <div class="job-logo">
                                <div class="job-logo-box">
                                    <img src="https://i.imgur.com/ZbILm3F.png" alt="">
                                </div>
                            </div>
                        </li>

                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title"><a href="#">Front End Developer</a></h2>
                                <div class="job-meta">
                                    <a class="meta-company" href="#">Company Awesome Ltd.</a>
                                    <span class="meta-date">Posted 14 days ago</span>
                                </div>
                                <div class="job-details">
                                    <span class="job-location">The Hague (The Netherlands)</span>
                                    <span class="job-type">Contract staff</span>
                                </div>
                            </div>
                            <div class="job-logo">
                                <div class="job-logo-box">
                                    <img src="https://i.imgur.com/ZbILm3F.png" alt="">
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </section>
        </main>
        <?php include_once('footer.php'); ?>
    </div>
</body>
</html> 
