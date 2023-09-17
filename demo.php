<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        function validateName() {
            var name = document.forms["sellerForm"]["name"].value;
            var namePattern = /^[A-Za-z\s]+$/;

            if (!name.match(namePattern)) {
                document.getElementById("nameError").innerText = "Name should contain only alphabet characters.";
                return false;
            } else {
                document.getElementById("nameError").innerText = "";
                return true;
            }
        }

        function validateCompany() {
            var company = document.forms["sellerForm"]["company"].value;

            if (company.trim() === "") {
                document.getElementById("companyError").innerText = "Company name is required.";
                return false;
            } else {
                document.getElementById("companyError").innerText = "";
                return true;
            }
        }

        function validateEmail() {
            var email = document.forms["sellerForm"]["email"].value;
            var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

            if (!email.match(emailPattern)) {
                document.getElementById("emailError").innerText = "Invalid email address.";
                return false;
            } else {
                document.getElementById("emailError").innerText = "";
                return true;
            }
        }

        function validatePhone() {
            var phone = document.forms["sellerForm"]["phone"].value;
            var phonePattern = /^[6-9]\d{9}$/;

            if (!phone.match(phonePattern)) {
                document.getElementById("phoneError").innerText = "Invalid phone number.";
                return false;
            } else {
                document.getElementById("phoneError").innerText = "";
                return true;
            }
        }

        function validatePassword() {
            var password = document.forms["sellerForm"]["password"].value;
            var passwordPattern = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

            if (!password.match(passwordPattern)) {
                document.getElementById("passwordError").innerText = "Password should be 6-16 characters, with at least one special character and one number.";
                return false;
            } else {
                document.getElementById("passwordError").innerText = "";
                return true;
            }
        }

        function validateRepeatPassword() {
            var password = document.forms["sellerForm"]["password"].value;
            var repeatPassword = document.forms["sellerForm"]["repeatPassword"].value;

            if (password !== repeatPassword) {
                document.getElementById("repeatPasswordError").innerText = "Passwords do not match.";
                return false;
            } else {
                document.getElementById("repeatPasswordError").innerText = "";
                return true;
            }
        }

        function validateSellerForm() {
            return (
                validateName() &&
                validateCompany() &&
                validateEmail() &&
                validatePhone() &&
                validatePassword() &&
                validateRepeatPassword()
            );
        }
    </script>
</head>
<body>
    <h1>Seller Registration</h1>
    <form name="sellerForm" onsubmit="return validateSellerForm()" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <span class="error" id="nameError"></span>
        </div>

        <div>
            <label for="company">Company:</label>
            <input type="text" id="company" name="company" required>
            <span class="error" id="companyError"></span>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <span class="error" id="emailError"></span>
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            <span class="error" id="phoneError"></span>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span class="error" id="passwordError"></span>
        </div>

        <div>
            <label for="repeatPassword">Repeat Password:</label>
            <input type="password" id="repeatPassword" name="repeatPassword" required>
            <span class="error" id="repeatPasswordError"></span>
        </div>

        <input type="submit" value="Register">
    </form>
</body>
</html>
