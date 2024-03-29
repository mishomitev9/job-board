<?php require_once('db-connect.php');
$_SESSION['logged_in'] = false;
if (!empty($_SESSION['$user_id'])) {
    // var_dump($_SESSION['$user_id']);

    $_SESSION['logged_in'] = true;
    $_SESSION['is_company'] = false;

    $query = "SELECT company_name FROM users WHERE id=?"; // SQL with parameters
    $stmt = $db_connect->prepare($query);
    $stmt->bind_param("i", $_SESSION['$user_id']);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    if ($result != false) {
        $user_data_fetched = $result->fetch_assoc(); // fetch data
        if ($user_data_fetched['company_name'] != "") {
            $_SESSION['is_company'] = true;
        }
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

<header class="site-header">
            <div class="row site-header-inner">
                <div class="site-header-branding">
                    <h1 class="site-title"><a href="<?php echo SITE_URL; ?>index.php">Job Offers</a></h1>
                </div>
                <nav class="site-header-navigation">
                    <ul class="menu">
                        <li class="menu-item">
                            <a href="<?php echo SITE_URL; ?>index.php">Home</a>                 
                        </li>
                        <li class="menu-item">
                        <?php
                        if (!$_SESSION['logged_in']) :
                            ?>
                    <a href="<?php echo SITE_URL; ?>register.php">Register</a>
                            <?php
                        else :
                            if ($_SESSION['is_company'] == true) :
                                ?>
                    <a href="<?php echo SITE_URL; ?>dashboard.php">Dashboard</a>
                    <a href="<?php echo SITE_URL; ?>actions-job.php">Create Job</a>
                                <?php
                            endif;
                            ?>
                    <a href="<?php echo SITE_URL; ?>profile.php">My Profile</a>
                             <?php
                        endif;
                        ?>
            </li>
                <li class="menu-item">
                <?php
                if (!$_SESSION['logged_in']) {
                    ?>
                    <a href="<?php echo SITE_URL; ?>login.php">Log In</a>
                <?php } else { ?>
                    <a href="<?php echo SITE_URL; ?>logout.php">Sign Out</a>
                <?php } ?>              
                </li>
            </ul>
                </nav>
                <button class="menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path fill="currentColor" class='menu-toggle-bars' d="M3 4h18v2H3V4zm0 7h18v2H3v-2zm0 7h18v2H3v-2z"/></svg>
                </button>
            </div>
        </header>
