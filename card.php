<!DOCTYPE html
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WellnessIndex</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
   body{
    background-color: #f0f2f5;
   }
  .card{
width: 400px;
height: 250px;
margin: 50px auto;
display:flex;
border-radius: 15px;
box-shadow: 0,0,0,0.2 rgba(0,0,0,0.2);
overflow:hidden;
text-align:center;
}
.left{
width: 40%;
display:flex;
align-items: center;
padding:20px;
}
.logo{
max-width:60px;
max-height:50px;
margin-bottom:6px;
}
.logo img{
justify-content-center;
}
.right{
width:60%;
padding:30px;
}
right h2
.right{
width:60%;
padding:30px;
}
 </style>
</head>
<body>
<?php 
$submitted =$_SERVER["REQUEST_METHOD"]=="POST";
?>
<div class="container mt-5">
<?php if(!$submitted): ?>
<h2 class="text-center mb-4"> Creating Your Visiting Card</h2>
<form action="" method="POST" enctype="multipart/form-data"> 
<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>
<div class="mb-3">
<label>Title</label>
<input type="text" name="title" class="form-control">
</div>
<div class="mb-3">
<label>Phone</label>
<input type="number" name="phone" class="form-control">
</div>
<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>
<div class="mb-3">
<label>Website</label>
<input type="text" name="website" class="form-control">
</div>
<div class="mb-3">
<label>Logo</label>
<input type="file" name="logo" class="form-control">
<div class="mb-3">
<label>Background-color</label>
<select name="bgcolor" class="form-select" required>
<option value="#ffe6f0">light Pink</option>
<option value="#e6e6fa">Pale Purple</option>
<option value="#c08081">dusty Rose</option>
<option value="#dcd6f7">Lavender Gray</option>
<option value="#ffdab9">Peach Puff</option>
<option value="#e6fff5">Mint Cream<option>

</select>
</div>
<div class="mb-3">
<label>Font Family</label>
<select name="font" class="form-select">
<option value="Arial, sans-serif">Arial</option>
<option value="Georgia, serif">Georgia</option>
<option value="Courier New,monospace">Courier New</option>
<option value="Tahoma, sans-serif">Tahoma</option>
</select>
</div>
<button type="submit" class="btn btn-outline-primary">Generate Card</button>
</form>
<?php else:
$name=$_POST['name'];
$title=$_POST['title'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$website=$_POST['website'];
$bgcolor=$_POST['bgcolor'];
$font=$_POST['font'];
$logoname='';
if(isset($_FILES['logo']) && $_FILES['logo']['error']==0){
$uploadDir='uploads/';
if(!is_dir($uploadDir)){
mkdir($uploadDir, 0775, true);
}
$logoName=$uploadDir.basename($_FILES['logo']['name']);
move_uploaded_file($_FILES['logo']['tmp_name'],$logoName);
}
$userData=[
"name" => $name,
"title" => $title,
"phone" => $phone,
"email" => $email,
"website" => $website,
"backgroundColor" => $bgcolor,
"font" => $font,
"logo" => $logoName
];
file_put_contents("card-data.json",json_encode($userData,JSON_PRETTY_PRINT));
?>
<div class="card" d-flex flex-row align-items-center justify-content-start gap-4 p-3" style="background-color: <?=htmlspecialchars($bgcolor) ?>; font-family: <?=htmlspecialchars($font) ?>;">
<?php if(!empty($logoName)) : ?>
<img src="<?= htmlspecialchars($logoName) ?>" class="logo" alt="Logo">
<?php endif; ?>
<h3><?= htmlspecialchars($name) ?> </h3>
<p><?= htmlspecialchars($title) ?></p>
<p>📞<?= htmlspecialchars($phone) ?> </p>
<p>📧<?= htmlspecialchars($email) ?> </p>
<p>🌐<?= htmlspecialchars($website) ?> </p>
</div>
<div class="text-center">
<a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-secondary mt-3">Create Another</a>
</div>
<?php endif; ?>
</div>
</body>
</html>
