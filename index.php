
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Welcome to Healthcare System</title>
    <style>
        body {
            
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .button {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:hover {
            background-color: #005f73;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Healthcare System</h1>
        <p>I am a:</p>
        <button class="button" onclick="location.href='patient.php'">Patient</button>
        <button class="button" onclick="location.href='doctor.php'">Doctor</button>
        <button class="button" onclick="location.href='pharmacy.php'">Pharmacy</button>
        <button class="button" onclick="location.href='company.php'">Pharmacy Company</button>
    </div>
    
</body>

</html>
