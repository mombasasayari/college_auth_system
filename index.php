<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>College Authentication System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="banner">
    <h1>WELCOME</h1>
    <p>Please login, register or reset your password</p>
</div>

<div class="container">
    <div class="platform-title">
        <span>&#128100; Login Platform</span>
    </div>

    <div class="panels">

        <div class="panel login">
            <h2>&#128100; Login</h2>
            <div class="msg" id="loginMsg"></div>
            <form id="loginForm" autocomplete="off">
                <label>Username</label>
                <input type="text" id="loginUsername" placeholder="Enter your username">

                <label>Password</label>
                <input type="password" id="loginPassword" placeholder="Enter your password">

                <div class="remember-row">
                    <label style="display:inline-flex;align-items:center;gap:5px;margin:0;">
                        <input type="checkbox" style="width:auto;"> Remember Me
                    </label>
                    <a href="#reset">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-login">&#10148; Login</button>
            </form>
        </div>

        <div class="panel register" id="reset">
            <h2>&#128101;&#10133; Register</h2>
            <div class="msg" id="registerMsg"></div>
            <form id="registerForm" autocomplete="off">
                <label>Full Name</label>
                <input type="text" id="regFullName" placeholder="Enter your full name">
                <div class="field-error" id="errFullName"></div>

                <label>Username</label>
                <input type="text" id="regUsername" placeholder="Choose a username">
                <div class="field-error" id="errUsername"></div>

                <label>Email</label>
                <input type="email" id="regEmail" placeholder="Enter your email">
                <div class="field-error" id="errEmail"></div>

                <label>Password</label>
                <input type="password" id="regPassword" placeholder="Create a password">
                <div class="field-error" id="errPassword"></div>

                <label>Confirm Password</label>
                <input type="password" id="regConfirmPassword" placeholder="Confirm your password">
                <div class="field-error" id="errConfirmPassword"></div>

                <button type="submit" class="btn btn-register">&#128100;&#10133; Register</button>
            </form>
        </div>

        <div class="panel reset">
            <h2>&#128274; Reset Password</h2>
            <div class="msg" id="resetMsg"></div>
            <form id="resetForm" autocomplete="off">
                <label>Registered Email</label>
                <input type="email" id="resetEmail" placeholder="Enter your registered email">

                <label>New Password</label>
                <input type="password" id="resetNewPassword" placeholder="Enter a new password">

                <div class="notice">
                    &#8505; Enter your registered email address and a new password. We will update it on our records.
                </div>

                <button type="submit" class="btn btn-reset">&#10148; Reset Password</button>
            </form>
        </div>

    </div>

</div>

<script src="assets/script.js"></script>
</body>
</html>