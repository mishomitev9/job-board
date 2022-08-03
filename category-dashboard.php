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
            <section class="section-fullwidth section-jobs-dashboard">
                <div class="row">                       
                    <div class="jobs-dashboard-header">
                        <div class="primary-container">                         
                            <ul class="tabs-menu">
                                <li class="menu-item">
                                    <a href="#">Jobs</a>                    
                                </li>
                                <li class="menu-item current-menu-item">
                                    <a href="#">Categories</a>
                                </li>
                            </ul>
                        </div>
                        <div class="secondary-container">
                            <div class="form-box category-form">
                                <form>
                                    <div class="flex-container justified-vertically">                                   
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Enter Category Name..."/>
                                        </div>
                                        <button class="button">
                                            Add New
                                        </button>
                                    </div>  
                                </form>
                            </div>
                        </div>
                    </div>
                    <ul class="jobs-listing">
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Category Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">Delete</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Category Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">Delete</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Category Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">Delete</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Category Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">Delete</a>
                                </div>
                            </div>
                        </li>
                        <li class="job-card">
                            <div class="job-primary">
                                <h2 class="job-title">Category Name</h2>
                            </div>
                            <div class="job-secondary centered-content">
                                <div class="job-actions">
                                    <a href="#" class="button button-inline">Delete</a>
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