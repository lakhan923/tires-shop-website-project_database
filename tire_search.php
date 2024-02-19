<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sivun Otsikko -->
    <title>Tire Search</title>

    <!-- Inline CSS for styling specific to this page -->
    <link rel="stylesheet" href="styles.css">

    <style>
        body,
        select,
        form {
            text-align: center;
        }

        .tire-results {
            max-width: 800px;
            margin: 20px auto;
            /* Center the box */
            background-color: lightblue;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .custom-advertisement_inside_tire_results_block {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .adImage {
            max-width: 100px !important;
            height: auto;
            margin-top: 10px;
        }

        /* Styling for the tire search form */
        .tire_search {
            max-width: 800px;
            margin: 20px auto;
            background-color: lightblue;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Styling for tire information display */
        .tire-info {
            margin-bottom: 15px;
        }

        /* Styling for labels in tire information */
        .info-label {
            font-weight: bold;
            color: black;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        /* Styling for select dropdown menu */
        select {
            width: 30%;
            padding: 10px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: darkgreen;
        }


        /* Media query for iPhone X (375x812) */
        @media only screen and (min-width: 375px) and (max-width: 812px) {

            /* styling for smaller screen sizes */
            .tire-results,
            .tire_search {
                max-width: 350px;
                margin: 20px auto;
                background-color: lightblue;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .adImage {
                max-width: 10px !important;
                height: auto;
                margin-top: 10px;
            }
        }

        /* Media query for iPad Pro (1024x1366) */
        @media only screen and (min-width: 1024px) and (max-width: 1366px) {

            .tire-results,
            .tire_search {
                max-width: 350px;
                margin: 20px auto;
                background-color: lightblue;
                padding: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        }
    </style>
</head>


<body>

    <?php
    //database connection
    include('dbconnection.php');
    ?>

    <!-- Heading for the tire search section -->
    <h1>Rengashaku</h1>

    <!-- Advertisement section -->
    <div class="advertisement">
        <a href="#" id="adLink1" target="_blank"></a>
        <span class="advertisement-label">Advertisement</span>
        <img src="" alt="Advertisement" id="adImage1">
        <div class="description" id="adDescription1">Talvirenkaiden myynti</div>
    </div>

    <div class="advertisement">
        <a href="#" id="adLink2" target="_blank"></a>
        <span class="advertisement-label">Advertisement</span>
        <img src="" alt="Advertisement" id="adImage2">
        <div class="description" id="adDescription2">Kesärenkaiden myynti</div>
    </div>

    <!-- Form for tire search -->
    <form class="tire_search" action="tire_search.php" method="GET">
        <label for="tire_size">Valitse Rengaskoko:</label>
        <!-- Dropdown select for tire sizes -->
        <select name="tire_size" id="tire_size">
            <?php

            // Retrieving tire sizes from the database
            $sql_sizesQuery = "SELECT DISTINCT Koko FROM renkaat"; //koko is the tire size column
            $sizesResult = mysqli_query($connection, $sql_sizesQuery);

            if ($sizesResult) {
                // Iterating over fetched tire sizes and creating option elements
                while ($sizeRow = mysqli_fetch_assoc($sizesResult)) {
                    $sizeValue = $sizeRow['Koko'];
                    echo "<option value=\"$sizeValue\">$sizeValue</option>";
                }

                // Freeing up memory after using the result
                mysqli_free_result($sizesResult);
            } else {
                echo "Error: " . mysqli_error($connection);
            }

            ?>
        </select>
        <!-- Lomakkeen lähetyspainike -->
        <input type="submit" value="Hae">


    </form>

    <?php

    // Check if a tire size is selected
    if (isset($_GET['tire_size'])) {
        $selectedSize = $_GET['tire_size'];

        // Query to get tires based on selected size
        $searchQuery = "SELECT * FROM renkaat WHERE Koko = '$selectedSize'";

        // Performing the search query
        $searchResult = mysqli_query($connection, $searchQuery);

        if ($searchResult) {
            // Displaying tire results
            echo '<div class="tire-results">';
            while ($row = mysqli_fetch_assoc($searchResult)) {
                // Display tire information (brand, model, price, etc.)
                echo '<div class="tire-info">';
                echo '<span class="info-label">Merkki:</span> ' . $row['Merkki'] . '<br>';
                echo '<span class="info-label">Malli:</span> ' . $row['Malli'] . '<br>';
                echo '<span class="info-label">Hinta:</span> $' . $row['Hinta'] . '<br>';
                echo '</div>';
            }

            mysqli_free_result($searchResult);

            // Display the advertisement images and details after the tire results
            echo '<div class="custom-advertisement_inside_tire_results_block">';
            echo '<a href="#" target="_blank"></a>';
            echo '<span class="advertisement-label">Advertisement</span>';
            echo '<img src="/rengaskuvia/ES31-kesärengas-HA.png" alt="Summer Advertisement" class="adImage">';
            echo '<div class="description">Kesärenkaiden myynti</div>';
            echo '</div>';

            echo '<div class="custom-advertisement_inside_tire_results_block">';
            echo '<a href="#" target="_blank"></a>';
            echo '<span class="advertisement-label">Advertisement</span>';
            echo '<img src="/rengaskuvia/WinterCraft-SUV-ice-WS51.png" alt="Winter Advertisement" class="adImage">';
            echo '<div class="description">Talvirenkaiden myynti</div>';
            echo '</div>';

            echo '</div>'; // Close tire-results container
        } else {
            echo "Ole hyvä ja valitse rengaskoko.";
        }
    }
    mysqli_close($connection);
    ?>

    <!-- JavaScript-tiedosto mainosten käsittelyä varten -->
    <script src="advertisement.js"></script>
</body>

</html>