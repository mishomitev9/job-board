<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="stylesheet" href="./css/master.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="site-wrapper">
        
     <?php include_once('header.php'); // Include Header once ?>

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
                        <h2 class="heading-title">Job Title - Submissions - 6 Applicants</h2>
                    </div>
                    <ul class="jobs-listing">
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Applicant Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Applicant Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Applicant Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Applicant Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Applicant Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">View</a>
                                </div>
                            </div>
                        </li>
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