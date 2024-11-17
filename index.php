<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management App</title>
    <link rel="icon" type="image/png" href="./images/reall.png" style="border-radius:10px;">
    <style>

body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
}

body::-webkit-scrollbar{
display:none;
}

a {
    text-decoration: none;
    color: inherit;
}


.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    background-color: black;
    color: white;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.logo {
    font-size: 1.5rem;
    font-weight: bold;
}

.nav-links {
    display: flex;
    gap: 1.5rem;
}

.nav-links a {
    color: white;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s;
}

.nav-links a:hover {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 5px;
}

.btn {
    border: 2px solid white;
    border-radius: 20px;
    padding: 0.5rem 1rem;
    color: white;
    transition: background-color 0.3s, color 0.3s;
}

.btn-primary {
    background-color: white;
    color: #008080;
}

.btn-primary:hover {
    background-color: #004c4c;
    color: white;
}

.btn-secondary {
    border-color: white;
}

.hamburger {
    display: none;
    cursor: pointer;
}


.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem;
    background-color: black;
}

.hero-text h1 {
    font-size: 2.5rem;
    color: #008080;
}

.hero-image img {
    width: 100%;
    max-width: 200px;
    border-radius:10px;
}


.features {
    padding: 2rem;
    background-color: #fff;
    text-align: center;
}

.feature-cards {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    margin-top: 1.5rem;
}

.feature-card {
    padding: 1rem;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.feature-card:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}

.feature-card img {
    width: 80px;
    margin-bottom: 1rem;
}

.feature-card h3 {
    color: #008080;
}


.footer {
    padding: 1rem;
    text-align: center;
    /* background-color: black; */
    color: teal;
    font-size:20px;
}


@media (max-width: 768px) {
    .hero {
        flex-direction: column;
        text-align: center;
    }

    .nav-links {
        display: none;
        flex-direction: column;
        background-color: #008080;
    }

    .nav-links.active {
        display: flex;
    }

    .hamburger {
        display: block;
    }
}

    </style>
</head>
<body>
    <header class="navbar">
    <img src="./images/reall.png" height="100px"width="100px" alt="Stock Management Illustration">
        <nav class="nav-links">
            <a href="#features">Features</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="./pages/login.php" class="btn">Login</a>
            <a href="./pages/signup.php" class="btn btn-secondary">Sign Up</a>
        </nav>
        <div class="hamburger" onclick="toggleMenu()">
            &#9776;
        </div>
    </header>

   
    <section class="hero">
        <div class="hero-text">
            <h1>Effortless Stock Management</h1>
            <p>Track, update, and manage your inventory with ease.</p>
            <a href="./pages/signup.php" class="btn btn-primary">Get Started</a>
        </div>
        <div class="hero-image">

        </div>
    </section>

 
    <section id="features" class="features">
        <h2>Why Choose StockEase?</h2>
        <div class="feature-cards">
            <div class="feature-card">
            <img src="./images/illust.png" alt="Stock Management Illustration">
                <h3>Real-Time Updates</h3>
                <p>Stay updated with instant stock changes and live tracking.</p>
            </div>
            <div class="feature-card">
            <img src="./images/illust.png" alt="Stock Management Illustration">
                <h3>Boost Efficiency</h3>
                <p>Optimize your workflow with our intuitive system.</p>
            </div>
            <div class="feature-card">
            <img src="./images/illust.png" alt="Stock Management Illustration">
                <h3>Detailed Reports</h3>
                <p>Get insights into your inventory performance anytime.</p>
            </div>
        </div>
    </section>

  
    <footer class="footer">
        <p>&copy; 2024 StockEase. All rights reserved.</p>
    </footer>

    <script>
    function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
          }

    </script>
</body>
</html>
