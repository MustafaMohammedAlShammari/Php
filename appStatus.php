<?php

require_once 'include/app_config_function.php';

$db = new app_config();
echo json_encode($db->checkAppStatus());

?>