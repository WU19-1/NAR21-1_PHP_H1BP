<?php 
    session_start();
    if(!isset($_SESSION['location']) || $_SESSION['location'] === ''){
        die(header('Location: /'));
    } else {
        $file = fopen($_SESSION['location'],"a+");
        fseek($file,0,SEEK_END);
        $len = ftell($file);
        rewind($file);

        fscanf($file,"%[^\n]",$test);
        $headerCount = substr_count($test,',') + 1;

        if(!isset($_SESSION['header']) || !$_SESSION['header']){
            rewind($file);
        }

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
        <div class="max-w-7xl mx-auto px-6">
            <div class="px-6 py-6 sm:px-0">
                <form action="./controller/downloader.php" method="post">
                    <input type="hidden" name="hcount" value="<?= $headerCount ?>">
                    <button type="submit" id="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-green-300 shadow-sm my-4 px-3 py-1 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Download
                    </button>
                    <table class="table-auto border-collapse border-2 border-green-800 shadow-sm rounded" >
                        <thead>
                            <tr>
                                <?php 
                                    if(!isset($_SESSION['header']) || $_SESSION['header'] == false){
                                        for($i = 1; $i <= $headerCount; $i++){
                                ?>
                                        <th class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium header"><?= "Header $i" ?></th>
                                <?php
                                        }       
                                    } else {
                                        $headers = explode(",",$test);
                                        for($i = 0; $i < count($headers); $i++){
                                ?>
                                        <th class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium header"><?= $headers[$i] ?></th>
                                <?php
                                        }
                                    }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 1;
                                while($data = fgetcsv($file,$len)){
                            ?>
                                <tr>
                                    <?php
                                        for($i = 0 ; $i < $headerCount; $i++, $count += 1){                                
                                    ?>
                                        <td class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium">
                                            <input type="text" class="data" name="<?= $count ?>" readonly value="<?= $data[$i] ?>">
                                        </td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <input type="hidden" name="count" value="<?= $count - 1 ?>">
                </form>
            </div>
        </div>
    </main>
    
</body>
<script src="./script/csv.js"></script>
</html>