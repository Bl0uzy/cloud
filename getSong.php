<?php
$path = $_GET['path'];
header("Content-Type: audio/*");
readfile($path);
