<?php
// connection details 
$hostname='127.0.0.1';
$username= 'root';
$password='Student@12345.';
$dbname= 'golden_arc_ministry';


// creating the connection 
$conn = new mysqli($hostname, $username, $password,$dbname);
if ($conn->connect_error) {
    die ('connection failed'.$conn->connect_error);}





















?>