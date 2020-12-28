<?php
    session_start();
    if(!isset($_SESSION['payload']) || $_SESSION['payload'] === ''){
        die(header('Location: /'));
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPH1BP</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <nav class="bg-blue-300">
        
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <a href="/">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="hidden lg:block h-8 w-auto" src="./assets/logo.png" alt="Workflow">
                        Developer Helper
                    </div>
                </a>
            </div>
        </div>

    </nav>

    <main>
        
        <div class="max-w-7xl mx-auto py-6 ">
            <div class="px-6 py-6 sm:px-0 ml-6">
                <?php
                    // echo $_SESSION['payload'];
                    echo "<pre>" . shell_exec($_SESSION['payload']) . "</pre>";
                ?>
            </div>
        </div>

    </main>
    
</body>
</html>