<?php require_once("config.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Product - YouPark</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6 form-container">
				<h1>Create a Product </h1>
				<?php 
				if(isset($_POST['submit_form']))
				{
				$title=$_POST['title'];  
				$price=$_POST['price']; 
				$folder = "uploads/";
$image_file=$_FILES['image']['name'];
 $file = $_FILES['image']['tmp_name'];
 $path = $folder . $image_file;  
 $target_file=$folder.basename($image_file);
 	//move image to the folder 
move_uploaded_file($file,$target_file); 
 $sql="INSERT into products(title,price,image) VALUES(:title,:price,:image)";
	    $stmt = $db->prepare($sql);
      $stmt->bindParam(':title', $title, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_STR);
      $stmt->bindParam(':image', $image_file, PDO::PARAM_STR);
       $stmt->execute();
       header("location:products.php");
				}
				?> 
			<form action="" method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label  class="label">Product Title </label>
    <input type="text" class="form-control" name="title" required>
  </div>
  <div class="mb-3">
    <label class="label">Product Price</label>
    <input type="number" class="form-control" name="price" required>
  </div>
  <div class="mb-3">
    <label class="label">Product Image</label>
    <input type="file" class="form-control" name="image" accept="image/*" required>
  </div>

  <button type="submit" class="btn btn-primary" name="submit_form">Create</button>

	</form>
		</div>
		<div class="col-sm-3"></div>
	</div>
	
</div>
</body>
</html>