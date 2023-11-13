<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
    
        <form action="send.php" method="post" autocomplete="off">
        <img class="img" src="img/logo.png" alt="logo">
            <h1>Login</h1>
            <div class="inputbox">
                <ion-icon name="mail-outline"></ion-icon>
                <input type="text" placeholder="Nombre" name="usuario" required>
                <label for="">Usuario</label>
            </div>
            <div class="inputbox">
                <ion-icon name="lock-closed-outline"></ion-icon>
                <input type="password" placeholder="Password" name="contrasena" required>
                <label for="">Password</label>
            </div>
        
            <input class="btn" type="submit" value="Ingresar">
            
        </form>
    </section>
</body>


</body>
</html>