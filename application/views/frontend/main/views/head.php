<?php
echo <<<HTML
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>$page_title - {$system_settings['system_name']}</title>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="$meta_description"/>
    <meta name="keywords" content="$meta_keywords"/>
    <meta name="author" content="{$system_settings['author']}" />

    <link rel="stylesheet" href="$system_assets_base_url/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="$system_assets_base_url/css/themify-icons.css"/>
    <link rel="stylesheet" href="$system_assets_base_url/css/simple-line-icons.css">
    
    <link rel="icon" type="image/png" href="$system_frontend_base_url/{$system_frontend_settings['favicon']}">
    <link rel="stylesheet" href="$system_assets_base_url/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="$system_assets_base_url/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="$system_assets_base_url/css/aos.css"/>

    <link rel="stylesheet" href="$system_assets_base_url/css/notifier.css"/>
    <link rel="stylesheet" href="$system_base_url/assets/global/plyr/plyr.css">

    <style>
        .d-none{display:none!important;}
        .payment-box-btns .d-hidden{display:none;}
        .bg-info {background-color: #d9edf7!important;}
    </style>

</head>
HTML;
?> 
