<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate date inputs
    $startDate = $_POST['start_date'] ?? '';
    $endDate = $_POST['end_date'] ?? '';
    
    if (!strtotime($startDate) || !strtotime($endDate)) {
        echo "Invalid date format. Please use YYYY-MM-DD.";
        exit;
    }

    // Prepare the date range for the query
    $dateRange = "fecha BETWEEN '$startDate' AND '$endDate'";

    // Query to get news articles within the date range
    $sql = "SELECT * FROM noticias WHERE $dateRange ORDER BY id DESC LIMIT 15";
    $result = $cnx->query($sql);

    // Display results
    if ($result->num_rows > 0) {
        echo "<h2>News Articles between " . date('F j, Y', strtotime($startDate)) . " and " . date('F j, Y', strtotime($endDate)) . "</h2>";
        
        echo "<table border='1'>";
        echo "<tr><th>Title</th><th>Date</th><th>Content</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['titulo']) . "</td>";
            echo "<td>" . date('F j, Y', strtotime($row['fecha'])) . "</td>";
            echo "<td>" . htmlspecialchars(substr($row['contenido'], 0, 200)) . "...</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No news articles found for the selected date range.";
    }
} else {
    // Form display
    ?>
    <h2>Search News Articles by Date Range</h2>
    <form action="" method="post">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        
        <button type="submit">Search</button>
    </form>
    <?php
}
?>
