<?php
$config = array(
    // Title of the site
    "Site_Title" => "What-A-Story",

    // Author and description of the site, which are meta tags in head
    "Site_Author" => "",
    "Site_Description" => "",

    // Is the site offline? If true, a message will appear on the homepage
    "Is_Offline" => false,
    // Offline site title
    "Is_Offline_Title" => "Site is offline...",
    // The message that will appear if the site offline
    "Is_Offline_Message" => "We'll back soon!"

);

if($config["Is_Offline"]){
    include("offline.php");
    die();
}
?>
