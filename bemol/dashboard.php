<?php

session_start();
require_once 'connection.php';

$connection;

// Check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

if(isset($_POST['shoppingcart'])){
    header("Location: shopping-cart.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>OmniSell</title>
</head>
<body>
    <header id="header-home">
        <nav>
            <a href="dashboard.php"><img src="./img/logo.png" alt="Logo Omnisell"></a>
            <p>OMNISELL</p>
            <form class="nav-buttons" method="post" action="dashboard.php">
                <button type="submit" id="logout" name="logout"><img src="./img/icon-threevertical.png" alt=""></button>
            </form>
        </nav>
        <img src="./img/Banner.png" alt="" id="banner">
    </header>
    <main>
        <?php
            require 'connection.php';
            $query = 'SELECT * FROM productions';
            $result = mysqli_query($connection, $query);
            $produtos = array();
            while($row = mysqli_fetch_assoc($result)){
                $produto[] = $row;
            }
            echo "
                <section id='popular'>
                    <h2>Popular Products</h2>
                    <div class='shoes'>
            ";
            if($result && mysqli_num_rows($result)){
                foreach($produto as $row){
                    $imageBlob = $row['image_prod'];
                    $base64Image = base64_encode($imageBlob);
                    echo "
                        <div class='shoes-carrousel' style='background-color: transparent; margin-left: 0px, align-self: center; width:100%';>
                            <div class='card-container'>
                                <header>
                                    <img src='data:image/jpeg;base64," . $base64Image . " alt='Image' class='shoes-images' style='width: 258px; height: 275px;'>
                                </header>
                                <main style='width:100%;'>
                                    <article>
                                        <div class='left-art'>
                                            <div class='stars' style='display: flex; flex-direction= row;'>";
                                            for($i=0;$i<$row['stars_prod'];$i++){
                                                    echo "<img src='./img/full-star.png' alt='star'>";
                                                };
                                            if($row['stars_prod'] < 5){
                                                for($i=$row['stars_prod']; $i<5; $i++){
                                                    echo "<img src='./img/empty-star.png' alt='star'>"; 
                                                };
                                            };echo "
                                            </div>
                                            <h3 style='width:80%;'>". $row['name_prod'] . "</h3>
                                        </div>
                                        <div class='right-art' style='justify-content: center; width: 100%; text-align: center;'>
                                            <div class='promo'>
                                                <p class='promocaopreco' style='text-align:center;'>$". $row['discount_prod'] . "</p>
                                            </div>
                                            <p class='realpreco'>$". $row['price_prod'] ."</p>

                                        </div>
                                    </article>
                                </main>
                                <footer>
                                    <form method='post' action='dashboard.php' style='width: 100%;'>
                                        <button type='submit' name='addtocart' style=''>ADICIONAR AO<img src='./img/icon-shoppingcart-white.png'></button>
                                        <input type='hidden' name='item_id' value='". $row['id_prod'] . "'/>
                                        <input type='hidden' name='item_name' value='". $row['name_prod'] . "'/>
                                        <input type='hidden' name='item_stars' value='". $row['stars_prod'] . "'/>
                                        <input type='hidden' name='item_price' value='". $row['price_prod'] . "'/>
                                        <input type='hidden' name='item_photo' value='data:image/jpeg;base64," . base64_encode($imageBlob) . "'/>
                                    </form>
                            
                                </footer>
                            </div>
                        </div>
                    ";
                }
            }    
            else{
                echo "<p>Nenhum Calçado Disponível</p>";
            }
        ?>
    </main>
</body>
</html>