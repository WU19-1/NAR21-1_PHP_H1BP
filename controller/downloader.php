<?php
    // die(var_dump($_POST));
    header('Content-Type : application/octet-stream');
    header('Content-Transfer-Encoding : Binary');
    
    
    if($_SERVER['HTTP_REFERER'] === $_SERVER['HTTP_ORIGIN'] . '/csv.php'){
        //download csv
        header("Content-Disposition: attachment; filename=\"download.csv\"");
        $headerCount = intval($_POST['hcount']);
        $totalData = intval($_POST['count']);
        for($i = 1 ; $i <= $totalData; $i+= $headerCount){
            $arr = [];
            for($j = 0; $j < $headerCount; $j++){
                $arr[$j] = $_POST[intval($j + $i)];
            }
            echo implode(",",$arr) . "\n";
        }
    } else if ($_SERVER['HTTP_REFERER'] === $_SERVER['HTTP_ORIGIN'] . '/hex.php'){
        //download hex
        $totalData = $_POST['count'];
        $all = "";
        for($i = 1; $i <= $totalData; $i++){
            if(($hex = hex2bin($_POST[intval($i)])) !== false){
                $all = $all . $hex;
            } else {
                session_start();
                $_SESSION['error'] = "The hex value must be between 0x00 and 0xff";
                die(header("Location:" . $_SERVER['HTTP_REFERER']));
                break;
            }
        }
        header("Content-Disposition: attachment; filename=\"download." . $_POST['filetype'] .  "\"");
        echo $all;
    }
?>