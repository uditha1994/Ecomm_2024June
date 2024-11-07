<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>

<body>
    <h2>User Registration</h2>
    <form id="regform">
        <label>Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label>First Name:</label>
        <input type="text" id="fname" name="fname" required><br>

        <label>Last Name:</label>
        <input type="text" id="lname" name="lname" required><br>

        <label>Contact:</label>
        <input type="tel" id="contact" name="contact" required><br>

        <label>Address Line 1:</label>
        <input type="text" id="address1" name="address1" required><br>

        <label>Address Line 2:</label>
        <input type="text" id="address2" name="address2"><br>

        <label>Address Line 3:</label>
        <input type="text" id="address3" name="address3"><br>

        <label>Date of Birth:</label>
        <input type="date" id="dob" name="dob" required><br><br>

        <button type="button" onclick="userReg();">Register</button>
    </form>

    <script src="js/main.js"></script>
</body>

</html>