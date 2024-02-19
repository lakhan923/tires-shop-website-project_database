<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Sivun Ostikko -->
    <title>Order Tires</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        h1 {
            text-align: center;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            padding-left: 60px;
        }

        .product {
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
            overflow: hidden;
            width: 200px;
            margin-right: 10px;
        }

        .product img {
            max-width: 100%;
            height: auto;
            display: block;
            margin-bottom: 10px;
        }

        .product p {
            margin: 0;
            font-size: 16px;
        }

        .product label {
            display: block;
            margin-top: 10px;
            font-size: 16px;
        }

        .product input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #confirmation-container {

            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f8f8f8;
            height: auto;
        }

        h2 {
            color: #333;
        }

        .product-details,
        .customer-info {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            display: block;
            background-color: #4caf50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            clear: both;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Media query for iPhone X (375x812) */
        @media only screen and (min-width: 375px) and (max-width: 812px) {
            .products-container {
                padding-left: 80px;
            }

            .product {
                width: 100px;
                padding-left: 10px;
            }
        }

        /* Media query for iPad Pro (1024x1366) */
        @media only screen and (min-width: 1024px) and (max-width: 1366px) {

            .products-container {
                padding-left: 150px;
            }
        }
    </style>
</head>

<body>

    <div class="banner">
        <div class="logo">
            <img src="/Taitaja2021/logo_dark.jpg" alt="Company Logo">
        </div>
        <div id="contact-info">
            <h1>Mustapään Auto Oy | Mustat Renkaat</h1>
            <p>Kosteenkatu 1, 86300 Oulainen</p>
            <p>Tel. 040-7128158</p>
            <p>email: <a href="mailto:myyntymies@mustatnyeks.net">myyntymies@mustatnyeks.net</a></p>
        </div>
    </div>
    <!-- Pääotsikko -->
    <h1>Order Tires</h1>
    <?php
    // Retrieving product/tires details from database(tietokannasta)
    include('tires_data_retrieving.php'); // this file fetches data from the database and printing 
    //the product details to the webpage
    ?>

    <!-- Tilausvahvistus säiliö-->
    <div id="confirmation-container">
        <!--Lomake tilauksen tekemiseen-->
        <h1>Place Your Order</h1>
        <form action="process_order.php" method="post">
            <div class="product-details">
                <!-- Toimitustapa -->
                <label for="delivery-method">Delivery Method:</label>
                <select id="delivery-method" name="delivery-method" required>
                    <option value="pickup">Nouto kaupasta</option>
                    <option value="matkahuolto">Matkahuolto</option>
                </select>
            </div>

            <!-- Asiakastiedot -->
            <div class="customer-info">
                <!-- Name -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <!-- Address -->
                <label for="address">Postal Address:</label>
                <input type="text" id="address" name="address" required>

                <!-- Email -->
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>

                <!-- Phone -->
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <!-- Lähetä-painike-->
            <button id="submit-order" type="submit">Tee Tilaus</button>
        </form>
    </div>

    <footer>
        <hr>
        <div id="feedback-section">
            <p><strong>Providing Feedback:</strong></p>
            <p>If you have any feedback or questions, please contact us via the provided email or phone number.</p>
            <p>Thank you for using Mustapään Auto Oy's tire search website. We appreciate your feedback and hope you
                find the perfect tires for your car!</p>
        </div>
        <hr>

        <p>&copy; Taitaja Semi-Finals 2021. Web Development</p>
    </footer>
</body>

</html>