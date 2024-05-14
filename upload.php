<?php
file_put_contents('history', serialize($_GET));
file_put_contents($_GET['name'].'history', serialize($_GET));
?>
