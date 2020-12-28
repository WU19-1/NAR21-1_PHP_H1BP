<?php 
    session_start();
    $_SESSION['location'] = '';
    $_SESSION['payload'] = '';
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
                <a href="#">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="hidden lg:block h-8 w-auto" src="./assets/logo.png" alt="Workflow">
                        Developer Helper
                    </div>
                </a>
            </div>
        </div>

    </nav>

    <main>
        <form action="./controller/uploader.php" method="post" class="form-container" id="uploader-form" enctype="multipart/form-data">
            
            <?php
                if(isset($_SESSION['error']) && $_SESSION['error'] !== "" ){
            ?>
                <div class="text-white px-6 py-4 mt-4 mb-0 border-0 rounded relative bg-red-500">
                    <span class="inline-block align-middle mr-8">
                        <?= $_SESSION['error'] ?>
                        <?php session_destroy() ?>
                    </span>
                </div>
            <?php
                }
            ?>

            <div class="max-w-7xl mx-auto py-6 ">
                <div class="px-4 py-6 sm:px-0">
                    <div class="border-4 border-dashed border-gray-200 rounded-lg h-96 dnd-container">
                        <div>
                            <p>Drag your file here, or click here</p>
                        </div>
                        <input type="file" name="upload" class="dnd-file">
                    </div>
                </div>
            </div>

            <div class="button-container">
                <button type="button" name="type" id="csv" class="mt-3 w-full inline-flex justify-center rounded-md border border-blue-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    CSV
                </button>
                <button type="button" name="type" id="hex" class="mt-3 w-full inline-flex justify-center rounded-md border border-blue-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Hex
                </button>
                <button type="button" name="type" id="compile" class="mt-3 w-full inline-flex justify-center rounded-md border border-blue-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-blue-700 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Execute
                </button>
            </div>
            
            <div class="submit-container" style="display: flex; justify-content: center; flex-direction: column; margin: 2vh 40vw;">
                <div class="with-header" id="with-header">   
                    <input type="checkbox" class="checked:bg-blue-600 checked:border-transparent" name="header" id="header">
                    <label for="header">With header</label>
                </div>
                <div class="exec-type" id="exec-type">
                    <input type="checkbox" name="exec" id="cpp" class="checked:bg-blue-600 checked:border-transparent" value="cpp">
                    <label for="cpp" style="margin-right: .75rem;">cpp</label>
                    <input type="checkbox" name="exec" id="python" class="checked:bg-blue-600 checked:border-transparent" value="python">
                    <label for="python">python</label>
                </div>
                <button type="submit" name="type" id="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-green-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Submit
                </button>
            </div>

        </form>

    </main>
    
</body>
<script src="./script/script.js"></script>
</html>