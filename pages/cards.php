
<style>
    .card {
        width: 220px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background-color 0.3s ease;
        text-align: center;
        background-color: #f8f9fa;
        color: #333;
        position: relative;
    }
    
    .card:hover {
        transform: scale(1.05);
        background-color: #e9ecef;
    }

    .card h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #007bff;
    }

    .card p {
        font-size: 24px;
        font-weight: bold;
        color: #495057;
    }

    .card a {
        text-decoration: none;
        font-size: 16px;
        color: #007bff;
        transition: color 0.3s;
        display: inline-block;
        margin-top: 15px;
    }

    .card a:hover {
        color: #0056b3;
    }

    .card::after {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(255, 255, 255, 0.5);
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 10px;
    }

    .card:hover::after {
        opacity: 1;
    }
</style>

<div class="card">
    <h3><?php echo htmlspecialchars($title);?></h3>
    <p><?php echo htmlspecialchars($description);?></p>
    <!-- <a href="<?php echo htmlspecialchars($link);?>">View Details</a> -->
</div>
