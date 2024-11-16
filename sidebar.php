<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
  * {
    margin: 0;
    padding: 0;
  }
  
  .sidebar {
    width: 200px;
    background-color: #333;
    display: flex;
    flex-direction: column;
    height: 100%;
    position: fixed;
    left: 0;
    transition: transform 0.3s ease;
  }
  
  .sidebar img {
    width: 3cm;
    height: 3cm;
    margin-top: 0.5cm;
    margin-left: 1cm;
    object-fit: cover;
    border-radius: 50%;
  }
  
  .sidebar .links {
    display: flex;
    flex-direction: column;
    margin-left: 1.5cm;
    margin-top: 1.7cm;
    gap: 1cm;
  }
  .links a{
    text-decoration: none;
    color: white;
  }
  
  .sidebar .logout {
    position: absolute;
    bottom: 0;
    left: 1.5cm;
  }


  .toggle-btn {
    display: none;
    position: fixed;
    top: 10px;
    left: 10px;
    background-color: #333;
    color: white;
    border: none;
    padding: 2px;
    cursor: pointer;
    font-size: 18px;
    z-index: 1000;
  }

  @media (max-width: 768px) {
    .sidebar {
      transform: translateX(-100%);
    }
    .toggle-btn {
      display: block;
    }
    .sidebar.show {
      transform: translateX(0);
    }
  }
</style>
</head>
<body>

<button class="toggle-btn" onclick="toggleSidebar()">☰</button>

<div class="sidebar" id="sidebar">
  <div class="logos">
    <img src="./images/logos.jpg" alt="logos">
  </div>   
  <div class="links">
    <a href="dashboard.php">Home</a>
    <a href="stockin.php">stockin</a>
    <a href="stockout.php">stockout</a>
    <a href="reports.php">reports</a>
  </div>   
  <div class="logout">
    <a href="./Backend/logout.php" style="color:orange;text-decoration:none;">Logout</a>
  </div>          
</div>
<script src="./js/sidebar.js"></script>
</body>
</html>
