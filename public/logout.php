<?php
session_start();
session_destroy();
header("Location: /sitevai/index.php");
exit();