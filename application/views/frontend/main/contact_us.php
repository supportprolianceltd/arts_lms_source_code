<?php
$contact_info = json_decode($system_frontend_settings['contact_info'], true);
$contact_info_email=nl2br($contact_info['email']);
$contact_info_phone=nl2br($contact_info['phone']);
$contact_info_address=nl2br($contact_info['address']);
$contact_info_office_hours=nl2br($contact_info['office_hours']);
require_once(__DIR__.'/views/contact_us.php');
?>