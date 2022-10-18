<?php

$conn = mysqli_connect("localhost", "root", "", "karate-kidz");

if (!$conn) {
    echo "Connection Failed";
};