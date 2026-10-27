





<?php
include 'connect.php';

$user_id = $_POST['user_id'] ?? 0;

$stmt = $conn->prepare(
    "SELECT user_id, username, email, birth_date, phone_number FROM users WHERE user_id = ?"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    echo $row['user_id'] . "," . $row['username'] . "," . $row['email'] . "," . $row['birth_date'] . "," . $row['phone_number'];
} else {
    echo "No Record";
}

$stmt->close();
$conn->close();
?>