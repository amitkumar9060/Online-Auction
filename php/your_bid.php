<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bids</title>
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
        <form action="your_bid.php" method="post">
            <button type="submit" name="check-bids">Check Your Bids</button>
        </form>

        <?php
        include 'conn.php';
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["check-bids"])) {
            $userEmail = $_SESSION["user_email"];
            $sql = "SELECT * FROM bid_details WHERE bidder_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $userEmail);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "<h2>Your Bid Details</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Item ID</th><th>Bid Amount</th><th>Bid Timestamp</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['bid_item_id'] . "</td>";
                    echo "<td>$" . $row['bid_amount'] . "</td>";
                    echo "<td>" . $row['bid_timestamp'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No bids found for the entered email: $userEmail</p>";
            }

            // Close database connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
