<?php
session_start();

if(!isset($_SESSION["keranjang"]))
{
    $_SESSION["keranjang"] = array();
}

session_destroy();

echo "<script>alert('akun logout')</script>";
echo "<script>location='index.php'</script>";


exit();
