<?php 
require('../Backend/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<style>
  * {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;  
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html, body {
    scroll-behavior: smooth;
  }

  header {
    position: fixed;
    width: 86.7%;
    left:5.3cm;
    top: 0;
    box-shadow: 4px 0px 12px 2px lightgray;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px;
    background-color: white;
    z-index: 1000;
  }

  .logo {
    display: flex;
    align-items: center;
    font-size: 24px;
    color: orange;
  }

  .logo img {
    height: 50px;
    width: 50px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .links ul {
    list-style: none;
    display: flex;
    gap: 20px;
  }

  .links a {
    text-decoration: none;
    color: gray;
    font-size: 18px;
    cursor: pointer;
  }

  .profile {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .profile img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
  }

  .dropdown {
    display: none;
    position: absolute;
    top: 60px;
    right: 20px;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 12px 2px lightgray;
  }

  .profile:hover .dropdown {
    display: block;
  }

  .plus{
    position: absolute;
    width: 1cm;
    height: 1cm;
    border-radius:50%;
    background-color: black;
    color:white;
    text-align: center;

  }
  .logo input{
    width: 7cm;
    height: 1cm;
    border-radius:10px; 
    box-shadow:0px 0px 12px lightgray;
    border:1px solid gray;
    position:fixed;
    left:7cm;
    padding-left:30px;

  }
  .logo button{
background-color: green;
position:fixed;
left:14.2cm;
color: white;
padding: 10px 20px;
border: none;
border-radius:10px;
cursor: pointer;
                
  }

.dropdown a{
  text-decoration: none;
}

  input::placeholder{
    color: orange;
  }

  /* Responsive styles */
  @media (max-width: 768px) {
    header {
      flex-direction: column;
      align-items: flex-start;
    }
    
    .links ul {
      flex-direction: column;
      gap: 10px;
    }
  }

  @media (max-width: 480px) {
    .logo {
      font-size: 20px;
    }

    .links a {
      font-size: 16px;
    }
  }
</style>
</head>
<body>

<header>
  <div class="logo">
    <div class="plus">
     <a href="./stockin-form.php" style="color:white;text-decoration:none; margin-top:5px;">+</a>
    </div>

    <form action="#" method="post">
    <button style="width:2cm;background:black;position:absolute;margin-top:-20px;" name="search">search</button>
    <!-- <span class="search-icon">&#128269;</span> -->
    <input style="width:12.4cm;margin-top:-20px;" type="text" name="input-search" class="search" id="#search" placeholder="Search Products...">
    </form> 
    <?php
// Search functionality
if (isset($_POST['search'])) {
    if (empty($_POST['input-search'])) {
        echo "<script>alert('Please fill in the search field before submitting.');</script>";
    } else {
        $look = $_POST['input-search'];
        $_SESSION['search_query'] = $look; 
        header("Location: ./search.php");
        exit();
    }
}
?>


</script>


  </div>


  <div class="profile">
  <?php 

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT user_id FROM user WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "<script>alert('User not found.');window.history.back();</script>";
    exit;
}

$added_by = $user['user_id'];

$select = $conn->query("SELECT * FROM profiles WHERE added_by = $added_by ORDER BY profile_id DESC LIMIT 1");

if ($select->num_rows > 0) {
    while ($row = $select->fetch_assoc()) { ?>
  <img src="../<?php echo $row['image']; ?>" alt="Profile">
    <?php }
} else { ?>
    <img style="" src="../images/defaults.png" alt="defaul pic">
<?php }
?>


    <span style="color:black;"><?php echo "Hello , ".ucfirst($_SESSION['username']); ?></span>
    <div class="dropdown">
      <a href="./profile.php">Add Profile</a><br><br>
      <a href="#">Security & Privacy</a><br><br>
      <a href="#">Dark Mode</a><br><br>
      <a href="../Backend/logout.php">Logout</a>
    </div>
  </div>
</header>

</body>
</html>