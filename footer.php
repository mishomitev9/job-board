<footer class="site-footer">
            <div class="row">
                <p>Copyright 2022 | Developer links: 
                    <a href="<?php echo SITE_URL ?>index.php">Home</a>,
                    <a href="<?php echo SITE_URL ?>dashboard.php">Jobs Dashboard</a>,
                    <a href="<?php echo SITE_URL ?>single.php">Single</a>,
                    <a href="<?php echo SITE_URL ?>login.php">Login</a>,
                    <a href="<?php echo SITE_URL ?>register.php">Register</a>,
                    <a href="<?php echo SITE_URL ?>submissions.php">Submissions</a>,
                    <a href="<?php echo SITE_URL ?>apply-submission.php">Apply Submission</a>,
                    <a href="<?php echo SITE_URL ?>view-submission.php">View Submission</a>,
                    <?php error_reporting(0);
                    if ($_SESSION['is_company']) {
                        ?>
                       <a href="<?php echo SITE_URL ?>actions-job.php">Create-Edit Job</a>,
                    <?php }
                    ?>
                    <a href="<?php echo SITE_URL ?>category-dashboard.php">Category Dashboard</a>,
                    <a href="<?php echo SITE_URL ?>profile.php">My Profile</a>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>
