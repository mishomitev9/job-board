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
                    <div class="flex-container centered-vertically centered-horizontally">
                        <div class="form-box box-shadow">
                            <div class="section-heading">
                                <h2 class="heading-title">My Profile</h2>
                            </div>
                            <form>
                                <div class="flex-container justified-horizontally">
                                    <div class="primary-container">
                                        <h4 class="form-title">About me</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="First Name*"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Last Name*"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Email*"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Password"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Repeat Password"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Phone Number"/>
                                        </div>
                                    </div>
                                    <div class="secondary-container">
                                        <h4 class="form-title">My Company</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Company Name"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" placeholder="Company Site"/>
                                        </div>
                                        <div class="form-field-wrapper">
                                            <textarea placeholder="Description"></textarea>
                                        </div>
                                    </div>      
                                </div>                  
                                <button class="button">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>  
        </main>

        <?php include_once('footer.php'); ?>
    </div>
</body>
</html>