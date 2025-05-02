<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Signup Patient</title>
    <link rel="stylesheet" href="signup/style.css">
</head>
<body>
    <div class="login-container">
        <div class="logo"><img src="2.png" alt=""></div>
        <form id="login-form" action="signin.php" method="post">
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your name" required>
        <div class="error-message"></div>
    </div> 
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <div class="error-message"></div>
    </div>
    <button type="submit">Sign In</button>
    
    <div class="options">
        <a href="#" id="signup-link">Don't have an account? Sign Up</a>
    </div>
</form>

<form id="signup-form" style="display: none;" action="signup.php" method="post">
    <h2 id="form-title"></h2> 
    <div class="form-group">
        <label for="signup-email">Username:</label>
        <input type="text" id="signup-username" name="signup-username" placeholder="Enter your name" required>
    </div>
    <div class="form-group">
        <label for="signup-email">Email:</label>
        <input type="email" id="signup-email" name="signup-email" placeholder="Enter your email" required>
    </div>
    <div class="form-group">
        <label for="signup-password">Password:</label>
        <input type="password" id="signup-password" name="signup-password" placeholder="Enter your password" required>
    </div>
    <div class="form-group">
        <label for="signup-confirm-password">Confirm Password:</label>
        <input type="password" id="signup-confirm-password" name="confirm-password" placeholder="Re-enter your password" required>
    </div>
    <button type="submit">Sign Up</button>
    <div class="error-message"></div>
    <div class="options">
        <a href="#" id="login-link">Already have an account? Sign In</a>
    </div>
</form>
        <script>
            document.getElementById('signup-link').onclick = function(e) {
                e.preventDefault();
                document.getElementById('login-form').style.display = 'none';
                document.getElementById('signup-form').style.display = 'block';
                };

            document.getElementById('login-link').onclick = function(e) {
                e.preventDefault();
                document.getElementById('signup-form').style.display = 'none';
                document.getElementById('login-form').style.display = 'block';
                };
        </script>
    </body>
</html>