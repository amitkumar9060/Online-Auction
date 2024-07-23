<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Bid</title>
    <link rel="stylesheet" href="../css/bid_form.css">
    <link rel="icon" type="image/png" href="../resources/new.png" />
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
        <?php
        session_start();
        include 'conn.php'; 

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
            $id = $_POST["id"];

            $sql = "SELECT id, item_name, description, image_url, previous_bid FROM items WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<div class='item-details'>";
                echo "<img src='" . $row['image_url'] . "' alt='Item Image'><br><br>";
                
                echo "<p>Title: " . $row['item_name'] . "</p><br>"; 
                echo "<p>Description: " . $row['description'] . "</p><br>";
                echo "<p>Previous Bid: $" . $row['previous_bid'] . "</p><br>";
                echo "</div>";
                ?>
                
                <form action="process_bid.php" method="post" class="bid-form">
                    <input type="text" name="bid_value" placeholder="Enter value of bid" required>
                    <input type="hidden" name="id" value='<?php echo $id; ?>' />
                    <button type="submit">Submit Bid</button>
                </form>
                <?php
                $stmt->close();
                $conn->close();
            } 
        }   
        else {
            $conn->close();
            header("Location: home.php");
            exit;
        }
        ?>
    </div>
</body>
</html>
