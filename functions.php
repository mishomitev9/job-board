<?php require_once('db-connect.php');

function time_message($post_date)
{
    $today_date = date_create();
    $post_date = date_diff($today_date, $post_date);
    $post_date = $post_date->format('%a');
    
    switch ($post_date) {
        case 0:
            return " today.";
        case 1:
            return " yesterday.";
        default:
            return $post_date." days ago.";
    }
}
