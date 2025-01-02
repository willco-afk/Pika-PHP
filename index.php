<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Backend Demo Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            position: relative;
            background-color: rgba(255, 204, 0, 0.8);
        }
        .container {
            text-align: center;
            border: 2px solid rgba(255, 165, 0, 1);
            border-radius: 10px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 600px;
        }
        .ripple-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .previous-submissions {
            text-align: left;
            margin-top: 20px;
        }
        .home-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 2;
        }
        .home-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="ripple-background"></div>
    <div class="container">
        <h1 class="text-3xl font-bold">Pokémon Demo Page with PHP</h1>
        
        <p class="mt-4">What's your favorite Pokémon?</p>
        
        <!-- Form to handle PHP POST request -->
        <form method="POST" action="submit.php"> <!-- Updated action to submit.php -->
            <input type="text" name="favorite_pokemon" required placeholder="Your Favorite Pokémon"
                class="border-2 border-orange-500 p-2 rounded-lg w-full max-w-xs">
            <button type="submit" class="mt-2 bg-green-500 text-white p-2 rounded-lg">Submit</button>
        </form>

        <?php
        // Handle form submission and show favorite Pokémon
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $favoritePokemon = htmlspecialchars($_POST['favorite_pokemon']);
            echo "<p class='mt-4 text-green-600 font-bold'>Thank you! Your favorite Pokémon is: $favoritePokemon</p>";
        }

        // Display previous submissions
        function displaySubmissions($file = 'submissions.log') {
            if (file_exists($file)) {
                $submissions = file($file, FILE_IGNORE_NEW_LINES);
                echo "<div class='previous-submissions'><h2 class='text-2xl font-bold'>Previous Submissions:</h2><ul class='list-disc list-inside'>";
                foreach (array_slice($submissions, -5) as $submission) {
                    echo "<li>$submission</li>";
                }
                echo "</ul></div>";
            }
        }

        displaySubmissions(); // Call function to display submissions
        ?>
    </div>

    <!-- Home Button -->
    <button class="home-btn" onclick="window.location.href='https://williamc.netlify.app'">Home</button>

</body>
</html>
