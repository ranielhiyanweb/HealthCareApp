<?php
include 'connect.php';

$mobileNo = $_POST['MobileNo'] ?? '';
$idNo     = $_POST['IdNo'] ?? '';

$stmt = $conn->prepare(
    "SELECT user_id FROM login WHERE mobile_no = ? AND id_no = ?"
);
$stmt->bind_param("ss", $mobileNo, $idNo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    echo "Success," . $row['user_id'];
} else {
    echo "No Record";
}

$stmt->close();
$conn->close();
?>