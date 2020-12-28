<?php 
    session_start();
    if(!isset($_SESSION['location']) || $_SESSION['location'] === ''){
        die(header('Location: /'));
    } else {
        $file = fopen($_SESSION['location'],"a+");
        $delim = explode(".",$_SESSION['location']);
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

                <?php
                    if(isset($_SESSION['error']) && $_SESSION['error'] !== "" ){
                ?>
                    <div class="text-white px-6 py-4 mb-4 mt-4 mb-0 border-0 rounded relative bg-red-500">
                        <span class="inline-block align-middle mr-8">
                            <?= $_SESSION['error'] ?>
                            <?php $_SESSION['error'] = ''; ?>
                        </span>
                    </div>
                <?php
                    }
                ?>

                <form action="./controller/downloader.php" method="POST">
                    <button type="submit" id="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-green-300 shadow-sm my-4 px-3 py-1 bg-white text-base font-medium text-green-700 hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Download
                    </button>

                    <input type="hidden" name="filetype" value="<?= $delim[count($delim) - 1] ?>">
                    
                    <table class="table-auto border-collapse border-2 border-green-800 shadow-sm rounded" >
                        <tbody>
                            <?php
                                $counter = 0x10;
                                $count = 1;
                                while(!feof($file)){
                            ?>
                                <tr>
                                    <td class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium"><?= sprintf("0x%08x",$counter) ?></td>
                                    <?php
                                        $pointer = fread($file,16);
                                        $len = strlen($pointer);
                                        for($i = 0 ; $i < 16 ; $i++, $count++){
                                    ?>
                                        <td class="border-2 border-light-blue-500 px-2 py-1 text-light-blue-600 font-medium">
                                            <input type="text" style="width: 2.5rem;" class="data" name="<?= $count ?>" readonly value="<?= ($i < $len) ? sprintf("%s",bin2hex($pointer[$i])) : "00" ?>">
                                        </td>
                                    <?php
                                        }
                                        $counter += 0x10;
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
<script src="./script/hex.js"></script>
</html>