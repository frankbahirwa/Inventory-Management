<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="styles.css"> 
   <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f1f3f5;
    margin: 0;
}



.container {
    background-color: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    width: 90%;
    max-width: 800px;
    margin-top:-2cm;
    padding-right:2cm;
    margin: auto;
    overflow: hidden;
}

.left-panel {
    background-color: #f9f9f9;
    display: none; 
}

.right-panel {
    padding: 20px;
}

.right-panel h2 {
    font-size: 2rem;
    margin-bottom: 20px;
}

input[type="text"],input[type="number"],
input[type="password"] {
    width: 94%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="password"]:focus {
    border-color: #007bff;
    outline: none;
}

button {
    width: 100%;
    padding: 10px;
    background-color: forestgreen; 
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #e68a00; 
}

.socials {
    text-align: center;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.social-icons img {
    width: 40px; 
    height: 40px; 
}


@media (min-width: 768px) {
    .container {
        flex-direction: row;
    }

    .left-panel {
        width: 50%;
        display: flex; 
        align-items: center;
        justify-content: center;
    }

    .right-panel {
        width: 50%;
    }
}

   </style>
</head>
<body>

    <main style="margin-top:2cm;">
        <div class="container">
            <div class="left-panel">
                <img src="../images/logos.jpg" alt="Work Desk" class="max-w-full h-auto"/>
            </div>
            <div class="right-panel">
                <h2>Sign up form</h2>
                <form id="login-form" method="post" action="../Backend/account.php">
                    <div>
                        <input type="text" id="username" name="username" placeholder="F-Name*" required />
                    </div>


                    <div>
                        <input type="password" id="password" name='password' placeholder="Password*" required />
                    </div>
                       
                    <button type="submit">Create account</button> <br><br>
                    Already Have Acount  <a href="../index.php" style="text-decoration:none;">Login</a>
                </form>
                <p id="error-message" style="color: red;"></p>
                <!-- <div class="socials">
                    <p>Or continue with</p>
                    <div class="social-icons">
                        <a href="https://www.google.com/accounts/signup"><img src="./images/Google.png" alt="Google"></a>
                        <a href="https://www.facebook.com/register"><img src="./images/Facebook.png" alt="Facebook"></a>
                        <a href="https://www.instagram.com/accounts/emailsignup/"><img src="./images/Instagram.png" alt="Instagram"></a>
                    </div>
                </div> -->
            </div>
        </div>
    </main>
    <script src="script.js"></script>
</body>
</html>
