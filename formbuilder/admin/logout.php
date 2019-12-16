<?php
include 'includes/common.php';

$ses->deleteAll();

$auth->redirect('login.php');
?>