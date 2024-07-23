<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wins</title>
    <link rel="stylesheet" href="../css/your_bid.css"> 
</head>
<body>
<nav class="navbar">
  <a href="home.php" class="logo"><img src="../resources/new.png" alt="Online Auction Logo"></a>
  <ul class="nav-links">
    <li><a href="add_item.php">Add Item</a></li>
    <li><a href="your_bid.php">Your Bids</a></li>
    <li><a href="your_items.php">Your Items</a></li>
    <li><a href="your_wins.php">Your Wins</a></li>
    <li><a href="about.php">About Us</a></li>
    <li><a href="logout.php" id="logout">Logout</a></li>
  </ul>
</nav>
    <div class="container">
        <form action="your_wins.php" method="post">
            <button type="submit" name="check-wins">Check Your Wins</button>
        </form>

        <?php
        include 'conn.php';
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["check-wins"])) {
            date_default_timezone_set('Asia/Kolkata');
            $userEmail = $_SESSION["user_email"];
            $currentDateTime = new DateTime();
            $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
            $sql = "SELECT * FROM items WHERE owner_email <> ? AND previous_bidder_email = ? AND end_time <= ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $userEmail, $userEmail,$formattedDateTime);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<h2>Your Won Items</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Item ID</th><th>Item Name</th><th>Description</th><th>Winning Price</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['item_name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['previous_bid'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No items won for the entered email: $userEmail</p>";
            }

            // Close database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
