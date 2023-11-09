<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
     <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 8px 0 10px rgba(0, 0, 0, 0.2);
           
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px -10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            justify-content: auto;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Registro</h2>
    <form action="procesar_registro.php" method="post">
        Nombre: <input type="text" name="usuario" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="contrasena" required><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>