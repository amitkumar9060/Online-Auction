<?php
include 'conn.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link rel="stylesheet" href="../css/add_item.css" />
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
    <h2 id="heading">Enter the details</h2>
    <div id="container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="name">Enter item name: </label>
            <input type="text" id="name" name="item_name" /><br><br>
            <label for="name">Enter item description: </label>
            <input type="text" id="name" name="description" /><br><br>
            <label for="name">Enter end time of item bidding: </label>
            <input type="text" id="name" name="end_time" /><br><br>
            <label for="name">Enter minimum bid: </label>
            <input type="text" id="name" name="min_bid" /><br><br>
            <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
            <input type="submit" value="Submit" name="submit" id="button" />
        </form>
    </div>
    
</body>
</html>