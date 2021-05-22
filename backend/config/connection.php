<?php
$conn = new mysqli("localhost", "root", "", "mateship");

if ($conn->connect_errno) {
    echo '<p> Erro ' . $conn->errno . '-->' . $conn->connect_error . '</p>';
    die();
}
