<?php
if (isset($_GET['logout'])) {
    setcookie('username', "", time() - 3600);
}
?>