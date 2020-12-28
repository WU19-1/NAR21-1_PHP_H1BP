<?php
    // die(var_dump($_POST));
    session_start();
    $type = $_POST['type'];

    if(!isset($_FILES['upload']) || $_FILES['upload']['name'] === ""){
        $_SESSION['error'] = "You must upload a file";
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } else if (!isset($type) || $type === ""){
        $_SESSION['error'] = "You must choose a type between CSV, Hex, or Compile";
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    } else if ($_FILES['upload']['size'] > 10240){
        $_SESSION['error'] = "File size exceeded 10kb";
        die(header('Location: ' . $_SERVER['HTTP_REFERER']));
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $uploadDir = str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);

    if($type === "csv"){
        //read csv

        $withHeader = (!isset($_POST['header']) || $_POST['header'] === '') ? false : true;
        $file = $uploadDir . '/upload/' . uniqid() . '.csv';

        if(move_uploaded_file($_FILES['upload']['tmp_name'], $file)){
            if( finfo_file($finfo,$file) !== 'text/plain' && finfo_file($finfo,$file) !== 'text/csv' ){
                $_SESSION['error'] = "Wrong type of file for CSV";
                die(header('Location: ' . $_SERVER['HTTP_REFERER']));
            }
            
            $_SESSION['location'] = $file;
            $_SESSION['header'] = $withHeader;
            die(header('Location: ../csv.php'));
        } else {
            $_SESSION['error'] = "Failed to upload file";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }

    }else if($type === "hex"){
        //read hex
        $exploded = explode(".",$_FILES['upload']['name']);
        $file = $uploadDir . '/upload/' . uniqid() . '.' . $exploded[count($exploded) - 1];
        // die(var_dump($file));

        if(move_uploaded_file($_FILES['upload']['tmp_name'], $file)){
            $_SESSION['location'] = $file;
            die(header('Location: ../hex.php'));
        } else {
            $_SESSION['error'] = "Failed to upload file";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
        
    }else if($type === "compile"){
        //compile cpp or python file
        
        $exploded = explode(".",$_FILES['upload']['name']);

        // die(var_dump($exploded[count($exploded) - 1]));

        if(!isset($_POST['exec']) || $_POST['exec'] === ""){
            $_SESSION['error'] = "You must choose either cpp or python to be executed";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        } else if($exploded[count($exploded) - 1] !== "cpp" && $exploded[count($exploded) - 1] !== "c" && $exploded[count($exploded) - 1] !== "py"){
            $_SESSION['error'] = "The uploaded file is neither cpp nor python";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
        
        if($_POST['exec'] === "cpp" && $exploded[count($exploded) - 1] === "cpp"){
            $_SESSION['payload'] = "g++ -o compile\\" . $name . '.exe upload\\' . $name . '.cpp && compile\\' . $name . ".exe"; 
        } else if($_POST['exec'] === "python" && $exploded[count($exploded) - 1] === "py") {
            //harus absolute path buat execute pythonnya (gatau kenapa, tapi harus kek gini :) )
            $_SESSION['payload'] = "C:\Users\Wahyu\AppData\Local\Programs\Python\Python38\python.exe " . $_SERVER['DOCUMENT_ROOT'] . "\\upload\\" . $name . ".py";
        } else {
            $_SESSION['error'] = "The file's extension didn't match the to the corresponding type";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }

        $name = uniqid();
        $file = $uploadDir . '/upload/' . $name  . '.' . $exploded[count($exploded) - 1];

        if(move_uploaded_file($_FILES['upload']['tmp_name'], $file)){
            $_SESSION['location'] = $file;
            die(header('Location: ../compile.php'));
        } else {
            $_SESSION['error'] = "Failed to upload file";
            die(header('Location: ' . $_SERVER['HTTP_REFERER']));
        }
    }
?>