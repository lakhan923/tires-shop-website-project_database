// This code executes when the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    // Array of advertisements
    const ads = [
        { link: "ad1_link", image: "/rengaskuvia/WinterCraft-SUV-ice-WS51.png", alt: "Winter Tires Advertisement", description: "Talvirenkaiden myynti" },
        { link: "ad2_link", image: "/rengaskuvia/ES31-kesärengas-HA.png", alt: "Summer Tires Advertisement", description: "Kesärenkaiden myynti" },
    ];
    
    // Variable to keep track of the current advertisement index
    let currentAdIndex = 0;

    // Function to rotate through advertisements
    function rotateAds() {
        // Get references to the HTML elements corresponding to the advertisement
        const adLink = document.getElementById('adLink' + (currentAdIndex + 1));// jossa id on adLink1, adLink2 tire_search.php sivulla.
        const adImage = document.getElementById('adImage' + (currentAdIndex + 1));// jossa id on adImage1, adImage2.
        const adDescription = document.getElementById('adDescription' + (currentAdIndex + 1)); //jossa id on adDescription1, adDescription2.

        // Update the advertisement content based on the current index
        adLink.href = ads[currentAdIndex].link; // Set the href attribute of the link
        adImage.src = ads[currentAdIndex].image; // Set the href attribute of the image
        adImage.alt = ads[currentAdIndex].alt; // Set the href attribute of the alt
        adDescription.innerText = ads[currentAdIndex].description; // Set the href attribute of the description

        // Increment currentAdIndex and reset to 0 if it exceeds the array length
        currentAdIndex = (currentAdIndex + 1) % ads.length;
    }

    // Call rotateAds initially to display the first advertisement
    rotateAds();

    // Set a timer to rotate ads every 5 seconds
    setInterval(rotateAds, 5000);
    //setInterval, makes the ads run automatically.
});


