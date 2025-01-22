<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password</title>
</head>
<body>
    <h1>Forgot Password</h1>
    <form action="../../controllers/forgotPasswordController.php" method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Submit</button>
    </form>
    
</body>
</html>