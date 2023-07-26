<!DOCTYPE html>
<html>

<head>
  <title>Add Product</title>
  <style>
    .container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 10%;
      margin-bottom: 5%;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="number"],
    .form-group input[type="date"],
    .form-group input[type="file"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    .form-group input[type="file"] {
      padding: 5px 10px;
    }

    .form-group button[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<?php
include('admin_header.html');
include('Conn.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['prod_name'];
  $price = $_POST['price'];
  $quant = $_POST['quantity'];
  $exp = $_POST['expiry_date'];
  $sql2 = "select * from products where name='$name'";
  $res2 = mysqli_query($con, $sql2);
  if ($res2 && mysqli_num_rows($res2) > 0) {
    echo "<script>alert('Product Already Added')</script>";
  } else {
    // Check if the file was uploaded without errors
    $targetFile;
    $targetFileType;
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
      $targetDir = "Images/";
      $targetFile = $targetDir . basename($_FILES["image"]["name"]);
      $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

      // Check if the uploaded file is an image
      $flag1 = 0;
      $validExtensions = ["jpg", "jpeg", "png", "gif"];
      if (in_array($imageFileType, $validExtensions)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
          // echo "Image uploaded successfully!";
          $flag1 = 1;
        }
      }
    }
    $img = $_FILES['image']['name'];
    $name = htmlspecialchars($name);
    $name = mysqli_real_escape_string($con, $name);
    $exp = htmlspecialchars($exp);
    $exp = mysqli_real_escape_string($con, $exp);
    $img = htmlspecialchars($img);
    $img = mysqli_real_escape_string($con, $img);
    $sql = "insert into products(name,price,quantity,expiry,image) values('$name','$price','$quant','$exp','$img')";
    $res = mysqli_query($con, $sql);
    if ($res && $flag1 == 1) {
      echo "<script>alert('Product added successfully')</script>";
    } else {
      echo "<script>alert('Something went wrong')</script>";
    }
  }
}
?>

<body>
  <div class="container">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
      <div class="form-group">
        <label for="prod_name">Product Name:</label>
        <input type="text" id="prod_name" name="prod_name" required>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>
      </div>
      <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required>
      </div>
      <div class="form-group">
        <label for="expiry_date">Expiry Date:</label>
        <input type="date" id="expiry_date" name="expiry_date" required>
      </div>
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
      </div>
      <center>
        <div class="form-group">
          <button type="submit">Submit</button>
        </div>
      </center>
    </form>
  </div>
</body>

</html>