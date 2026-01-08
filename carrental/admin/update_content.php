<?php
include('../includes/config.php');

$pages = [
    'aboutus' => "At Torq, we are dedicated to providing an unparalleled car rental experience. Founded on the principles of quality, reliability, and exceptional customer service, we offer a curated fleet of the world's most prestigious vehicles. Whether you're looking for a performance-driven sports car for a weekend getaway or a sophisticated sedan for business, our mission is to ensure your journey is as remarkable as your destination. Our team of experts is committed to maintaining our vehicles to the highest standards, ensuring safety and style every time you get behind the wheel.",
    'faqs' => "<h3>How do I book a car?</h3><p>Booking is easy! Simply browse our fleet, select your desired vehicle, and use the booking form on the details page. Our team will confirm your reservation shortly.</p><h3>What are the requirements for renting?</h3><p>You must be at least 21 years old and hold a valid driver's license. For certain premium models, age and documentation requirements may vary.</p><h3>Is insurance included?</h3><p>Yes, all our rentals include standard comprehensive insurance. Additional coverage options are available for extra peace of mind.</p>",
    'privacy' => "Your privacy is of the utmost importance to us. At Torq, we collect and use your personal information solely to process your bookings and improve our services. We employ advanced security measures to protect your data and never share your details with third parties without your explicit consent. For a full breakdown of how we handle your information, please contact our support team.",
    'terms' => "By using Torq's services, you agree to our terms and conditions. All drivers must adhere to local traffic laws and maintain our vehicles in excellent condition. Any damages or late returns may incur additional charges as outlined in your rental agreement. We reserve the right to refuse service to any individual who does not meet our safety or eligibility criteria."
];

foreach ($pages as $type => $detail) {
    $sql = "UPDATE tblpages SET detail=:detail WHERE type=:type";
    $query = $dbh->prepare($sql);
    $query->bindParam(':detail', $detail, PDO::PARAM_STR);
    $query->bindParam(':type', $type, PDO::PARAM_STR);
    $query->execute();
}

$vehicle_overview = "This vehicle represents the pinnacle of engineering and design. Equipped with advanced safety features, a high-performance engine, and a luxurious interior, it offers a driving experience that is both exhilarating and refined. Every detail has been meticulously crafted to provide maximum comfort and style for your journey.";

$sql = "UPDATE tblvehicles SET VehiclesOverview=:overview";
$query = $dbh->prepare($sql);
$query->bindParam(':overview', $vehicle_overview, PDO::PARAM_STR);
$query->execute();

echo "Content updated successfully!";
?>
