<?php
// $conn = new mysqli("localhost", "root", "", "mateship");
$conn = new mysqli("192.168.2.100","webmaster","6m0H%m^3FWzt75!8","test");

if ($conn->connect_errno) {
    echo '<p> Erro ' . $conn->errno . '-->' . $conn->connect_error . '</p>';
    die();
}
