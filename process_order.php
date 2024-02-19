<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
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

// Hae lomakkeen tiedot
$deliveryMethod = $_POST['delivery-method'];
$name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$tireQuantities = $_POST['quantity'];
// Vahvista lomakkeen tiedot
if (empty($deliveryMethod) || empty($name) || empty($address) || empty($email) || empty($phone) || empty($tireQuantities)) {
    // Jos jokin pakollinen kenttä on tyhjä, ohjaa takaisin tires_shop sivulle virheilmoituksella
    header("Location: tires_shop.php?error=1");
    exit;
}

// Tarkista rengasvarasto ja vähennä varastoa
foreach ($tireQuantities as $selectedTireID => $quantity) {
    // Hae nykyinen varastomäärä tietokannasta(database)
    $sql = "SELECT Saldo FROM renkaat WHERE RengasID = $selectedTireID";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentStock = $row['Saldo'];

    // Tarkista, ylittääkö tilausmäärä saatavilla olevan varaston
    if ($quantity > $currentStock) {
        // Display error message and prevent order processing
        echo "Virhe: Rengastunnukselle ei ole tarpeeksi varastossa $selectedTireID";
        exit; // tai ohjaa tire_shop sivulle
    }

    // Pienennä varastomäärää tietokannassa
    $newStock = $currentStock - $quantity;
    $updateSql = "UPDATE renkaat SET Saldo = $newStock WHERE RengasID = $selectedTireID";
    $conn->query($updateSql);
}

// Laske kokonaishinta

// Alusta kokonaishinta muuttuja
$totalPrice = 0;

// Renkaiden hintojen hakeminen tietokannasta ja kokonaishinnan laskeminen
foreach ($tireQuantities as $selectedTireID => $quantity) {
    // // Hae renkaiden hinta tietokannasta $RengasID perusteella
    $sql = "SELECT Hinta FROM renkaat WHERE RengasID = $selectedTireID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Hae renkaan hinta tuloksesta(result)
        $row = $result->fetch_assoc();
        $tirePrice = $row['Hinta'];

        // Laske renkaan välisumma
        $subtotal = $tirePrice * $quantity;

        // Lisää välisumma kokonaishintaan
        $totalPrice += $subtotal;
    } else {
        echo "Virhe: Renkaiden hintaa ei löydy henkilötodistuksesta $selectedTireID";
    }
}

//  Sisällytä order_confirmation sivu
include 'order_confirmation.php';


// Sulje tietokantayhteys
$conn->close();

