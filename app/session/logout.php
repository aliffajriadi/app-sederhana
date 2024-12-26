<?php
session_start();

session_unset();
session_destroy();

echo "Session telah dihapus. <a href='../index.php'></a>";
?>
