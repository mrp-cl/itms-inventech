<?php
include("../config/db.php");

$user_id = intval($_GET['id']);

$sql = "SELECT type, description FROM devices WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {

    echo "<ul>";

    while ($row = $result->fetch_assoc()) {
        echo "<li>
                <strong>" . htmlspecialchars($row['type']) . "</strong> 
                - " . htmlspecialchars($row['description']) . "
              </li>";
    }

    echo "</ul>";

} else {
    echo "<p style='text-align:center; color:gray;'>No device assigned.</p>";
}
?>