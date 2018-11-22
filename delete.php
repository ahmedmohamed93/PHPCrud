<?php
require "db.php";

$id = $_GET['id'];
$stmt = $con->prepare("DELETE FROM peopple WHERE id = :id");
$row = $stmt->execute([":id" => $id]);
if($row){
    header("location:index.php");
}