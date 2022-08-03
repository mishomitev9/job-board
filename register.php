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
                                <h2 class="heading-title">Register</h2>
                            </div>
                            <form>
                                <div class="flex-container justified-horizontally">
                                    <div class="primary-container">
                                        <h4 class="form-title">About me</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="fname" placeholder="First Name*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="lname" placeholder="Last Name*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="email" placeholder=" Email*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="password" placeholder="Password*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="passwordrep" placeholder="Repeat Password*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="phone_num" placeholder="Phone Number" />
                                        </div>
                                    </div>
                                    <div class="secondary-container">
                                        <h4 class="form-title">My Company</h4>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_name" placeholder="Company Name" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="company_site" placeholder="Company Site" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <textarea name="company_description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="button">
                                    Register
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