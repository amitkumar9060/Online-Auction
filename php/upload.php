<?php
include 'conn.php'; 
session_start();
?>

<?php
$target_dir = "../resources/images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>

<?php 
    $previous_bidder_email=$_SESSION['user_email'];
    $item_name=$_POST['item_name'];
    $item_description=$_POST['description'];
    date_default_timezone_set('Asia/Kolkata');
    $end_time=$_POST['end_time'];
    $posted_time=date( 'Y-m-d h:i:s' );
    $previous_bid=$_POST['min_bid'];
    $image_name=htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    $image_url='../resources/images/'.$image_name;
    $owner_email=$_SESSION['user_email'];
    $sql2 = "INSERT INTO `items`(`item_name`,`description`,`image_url`,`previous_bid`,`previous_bidder_email`,`posted_time`,`end_time`,`owner_email`) VALUES ('$item_name','$item_description','$image_url','$previous_bid','$previous_bidder_email','$posted_time','$end_time','$owner_email'); ";
    $conn->query($sql2);
    header("Location: home.php"); 
    exit();
?>