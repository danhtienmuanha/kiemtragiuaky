<?php
include 'config/connect.php';

$sql = "SELECT COUNT(*) AS total FROM NHANVIEN";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_pages = ceil($row["total"] / 5);

echo "<div style='text-align: center;'>";

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='index.php?page=".$i."'>".$i."</a> ";
}

echo "</div>";
$conn->close();
?>
