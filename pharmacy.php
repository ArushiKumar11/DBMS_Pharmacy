<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Healthcare System Portal</title>
    <style>
        body { padding: 20px; }
        .container { display: flex; justify-content: space-around; max-width: 1200px; margin: auto; }
        .form-container { flex: 1; margin: 10px; padding: 20px; border: 1px solid #ccc; }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background-color: #008CBA; color: white; cursor: pointer; }
        .divider { margin: 20px; border-right: 1px solid #ccc; }
    </style>
</head>
<body>
<div class="container">
    <!-- Login Form -->
    <div class="form-container">
        <h2>Login</h2>
        <form action="pharmacy_login.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Registration Form -->
    <div class="form-container">
        <h2>Register</h2>
        <form action="pharmacy_register.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Address" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</div>
</body>
</html>
