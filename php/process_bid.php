<?php
session_start();
include 'conn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bid_value"])) {
    $userEmail = $_SESSION["user_email"];
    $id = $_POST["id"];
    $bidAmount = $_POST["bid_value"];

    // Retrieve the last bid amount for the art piece
    $sql = "SELECT previous_bid FROM items WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($lastBidAmount);
    $stmt->fetch();
    $stmt->close();

    if ($bidAmount > $lastBidAmount) {
        $sqlUpdate = "UPDATE items SET previous_bid = ? , previous_bidder_email = ? WHERE id = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param("dsd", $bidAmount,$userEmail,$id);
        $stmtUpdate->execute();
        $stmtUpdate->close();

        
        $sqlInsert = "INSERT INTO bid_details (bid_amount,bid_item_id,bidder_email,bid_timestamp) VALUES (?, ?, ?, NOW())";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("dds", $bidAmount, $id, $userEmail);
        $stmtInsert->execute();
        $stmtInsert->close();
            
            
        header("Location: home.php");
        exit;
        
    } else {
        echo '<script>alert("Your bid amount must be higher than the previous bid."); history.back();</script>';
    }

    // Close the database connection
    $conn->close();
} 
else {
    header("Location: home.php");
    exit;
}

?>
