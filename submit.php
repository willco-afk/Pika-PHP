<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $favoritePokemon = htmlspecialchars($_POST['favorite_pokemon']);

    // Log the submission
    $file = 'submissions.log'; // Ensure this file is writable
    $date = date('Y-m-d H:i:s');
    $entry = "$date: $favoritePokemon\n";
    file_put_contents($file, $entry, FILE_APPEND);

    // Display the result and previous submissions
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Submission Result</title>
        <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: rgba(255, 204, 0, 0.8);
            }
            .container {
                text-align: center;
                border: 2px solid rgba(255, 165, 0, 1);
                border-radius: 10px;
                padding: 20px;
                background-color: rgba(255, 255, 255, 0.9);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                max-width: 600px;
                width: 100%;
            }
            .previous-submissions {
                text-align: left;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h1 class='text-3xl font-bold'>Your Submission</h1>
            <p class='mt-4 text-green-600 font-bold'>Your favorite Pokémon is: $favoritePokemon!</p>
            <a href='index.php' class='mt-4 inline-block bg-blue-500 text-white p-2 rounded-lg'>Go Back</a>
            ";

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

    echo "    </div>
    </body>
    </html>";
} else {
    echo "Invalid request!";
}
?>