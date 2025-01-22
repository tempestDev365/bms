
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
</head>
<body>
    <form action="../../controllers/resetPasswordController.php" method="POST">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword" required>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <button type="submit">Submit</button>
    </form>
</body>
</html>