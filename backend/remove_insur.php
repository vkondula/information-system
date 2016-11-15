<?php
session_start();
require_once("insurance.php");
$id = $_POST["delete_id"];
$changed = remove_insurance_comps($id);
if ($changed != 1) { $_SESSION["error"] = "Záznam nebyl odstraňen"; }
header("Location: ../frontend/insurance.php");