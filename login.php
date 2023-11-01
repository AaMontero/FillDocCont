<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="send.php" method="post" autocomplete="off">
<img src="logo.png" alt="">
        
   <div class="input-group" >    
    <div class="input-container">
        <input type="text" placeholder="Nombre" name="usuario">
        <i class="fa-solid fa-user"></i>
    </div>

    <div class="input-container">
        <input type="password" placeholder="Password" name="clave">
        <i class="fa-solid fa-lock"></i>
    </div>
   
        <input class="btn" type="submit" value="Ingresar">
   </div>
    
</form>

</body>
</html>