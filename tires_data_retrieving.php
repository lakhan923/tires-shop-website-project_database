<?php
// database connection
$servername = "localhost";
$username = "root";
$password = "database_password";
$dbname = "project_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query hakeaksesi tuotetiedot tietokannasta
$sql = "SELECT RengasID, Merkki, Malli, Hinta, ImagePath FROM renkaat";
// Execute the query
$result = $conn->query($sql);

// Prosessilomake renkaiden tilaamiseen
echo '<form action="process_order.php" method="post">';

// Tarkista, onko kyselyllä palautettu tuloksia
if ($result->num_rows > 0) {
    // Jos tuloksia on, aloita tuotteiden säiliö
    echo '<div class="products-container">';

    // Lähtötiedot jokaiselle riville (jokainen rengas)
    while ($row = $result->fetch_assoc()) {
        // Tulosta HTML-merkintä jokaiselle renkaalle
        echo '<div class="product">';
        echo '<img src="' . $row["ImagePath"] . '" alt="Tire Image">'; // Käytä tietokannan Kuva-saraketta
        echo '<p>Tuotteen Nimi: ' . $row["Merkki"] . ' ' . $row["Malli"] . '</p>';
        echo '<p>Hinta: $' . $row["Hinta"] . '</p>';
        echo '<label for="quantity_' . $row["RengasID"] . '">Quantity:</label>';
        echo '<input type="number" id="quantity_' . $row["RengasID"] . '" name="quantity[' . $row["RengasID"] . ']" min="0" value="0">'; // Quantity input with unique ID and name
        echo '</div>';
    }
    echo '</div>'; // Closing container for products
} else {
    echo "0 results";
}
$conn->close();
