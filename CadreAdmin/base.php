<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title><?= $page_title ?></title>
    <style>
        /* Additional CSS for body */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        /* Style for the image */
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Ensure it's behind other content */
            object-fit: cover; /* Cover the entire body */
            opacity: 0.5; /* Optional: Adjust opacity */
        }
    </style>
</head>
<body>
    <!-- Background image -->
    <img class="background-image" src="../images/clinique.jpg" alt="Background Image">
    
    <!-- Rest of your HTML content goes here -->
    <div></div>
