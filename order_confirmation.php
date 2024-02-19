<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sivun Ostikko -->
    <title>Order Confirmation</title>
    <style>
        /* Tyylit koko sivun vartalolle */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        /* Styles for main order confirmation container */
        .order-confirmation {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .customer-info,
        .ordered-products,
        .order-summary {
            background-color: #fafafa;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .customer-info h2,
        .ordered-products h2,
        .order-summary h2 {
            color: #333;
            margin-bottom: 15px;
        }

        .customer-info p,
        .ordered-products p,
        .order-summary p {
            margin: 5px 0;
        }

        .ordered-products ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .ordered-products li {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .ordered-products li:last-child {
            border-bottom: none;
        }

        .ordered-products img {
            max-width: 100px;
            height: auto;
            margin-right: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div class="order-confirmation">
        <div class="logo">
            <img src="/Taitaja2021/logo_dark.jpg" alt="Company Logo">
        </div>
        <h1>Order Confirmation</h1>
        <div class="customer-info">
            <h2>Customer Information</h2>
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        </div>
        <div class="ordered-products">
            <h2>Ordered Products</h2>
            <ul>
                <?php
                // silmukka(loop) läpi kaikki valitut renkaat ja näyttää sen tiedot
                foreach ($tireQuantities as $selectedTireID => $quantity) {
                    if ($quantity > 0) { // Tarkista, onko quantity suurempi kuin 0

                        // Hae renkaiden tiedot tietokannasta $selectedTireID:n perusteella
                        $sql = "SELECT Merkki, Malli, Hinta, ImagePath FROM renkaat WHERE RengasID = $selectedTireID";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo '<li>';
                            echo '<img src="' . $row["ImagePath"] . '" alt="Tire Image">';
                            echo '<p><strong>' . $row["Merkki"] . ' ' . $row["Malli"] . '</strong></p>';
                            echo '<p><strong>Hinta:</strong> $' . $row["Hinta"] . '</p>';
                            echo '<p><strong>Quantity:</strong> ' . $quantity . '</p>'; // Näytä valittu määrä
                            echo '</li>';
                        }
                    }
                }
                ?>
            </ul>
        </div>
        <div class="order-summary">
            <h2>Order Summary</h2>
            <p><strong>Total Price:</strong> $<?php echo $totalPrice; ?></p>
            <p><strong>Delivery Method:</strong> <?php echo $deliveryMethod; ?></p>
        </div>
    </div>
</body>

</html>
