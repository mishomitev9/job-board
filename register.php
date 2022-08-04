<?php
// Include the connection file
include 'connection.php';
// Check the button Register and INSERT the data in table users from the webpage form
if (isset($_POST['register'])) {
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $phone=$_POST['phone'];
    $company_name=$_POST['company_name'];
    $company_site=$_POST['company_site'];
    $company_description=$_POST['company_description'];

    $sql="INSERT INTO users (fname, lname, email, password, phone, company_name, company_site, company_description)
    values('$fname','$lname','$email','$password','$phone','$company_name','$company_site','$company_description')";

    $result=mysqli_query($conn, $sql);
    if (!$result) {
        die(mysqli_error($conn));
    }
}

?>

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
                            <form method="post">
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
                                            <input type="text" name="email" placeholder="Email*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="password" placeholder="Password*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="password_rep" placeholder="Repeat Password*" />
                                        </div>
                                        <div class="form-field-wrapper">
                                            <input type="text" name="phone" placeholder="Phone Number" />
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
                                <button type="submit" class="button" name="register">
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

