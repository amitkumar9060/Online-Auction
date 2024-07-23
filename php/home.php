<?php
  session_start();
  if (isset($_SESSION['user_email'])){}
  else{
		header("Location: landing.php");
		exit();
	}
?>

<?php
include 'conn.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="../resources/new.png" />
  <link rel="stylesheet" href="../css/home.css">
  <title>Online Auction</title>
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
<section class="hero">
  <div class="hero-content">
    <h1 class="hero-text">Online Auction</h1>
    <p class="hero-subtext">A Safe Haven for Bidders and Sellers alike</p>
    <img src="../resources/full2.jpg" alt="Online Auction gallery image">
  </div>
</section>

<section class="item-gallery">
  <?php

    date_default_timezone_set('Asia/Kolkata');
    $userEmail = $_SESSION["user_email"];
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    $sql = "SELECT id, item_name, description, image_url, previous_bid FROM items WHERE owner_email <> ? AND end_time > ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userEmail, $formattedDateTime);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $counter = 0; 
  
    while ($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $itemName = $row["item_name"];
      $description = $row["description"];
      $imageURL = $row["image_url"];
      $previousBid = $row["previous_bid"];
  ?>

  <?php
    if ($counter % 3 === 0) {
      echo '<div class="item-row">';
    }
  ?>
  
  <div class="item-item">
    <img src="<?php echo $imageURL; ?>" alt="Item Piece <?php echo $id; ?>">
    <p class="item-name"><?php echo $itemName; ?></p>
    <div class="bid-options">
      <p class="previous-bid">Previous Bid: $<?php echo $previousBid; ?></p>
      
      <form class="new-bid-form" action="submit_bid.php" method="post">
        <!-- <label for="new-bid">Place New Bid:</label>
        <input type="number" name="new-bid"  step="0.01" required placeholder="previous bid is $<?php echo $previousBid; ?>"> -->
        <input type="hidden" name="want-to-bid" value="yes">
        <input type="hidden" name="id" value='<?php echo $id; ?>' />
        <button type="submit" id="bid-button">Submit a bid?</button>
      </form>
    </div>
  </div>

  <?php
    $counter++;
    if ($counter % 3 === 0) {
      echo '</div>';
    }
  ?>
  
  <?php
    }
    if ($counter % 3 !== 0) {
      echo '</div>';
    }
  ?>

</section>
</body>
</html>
