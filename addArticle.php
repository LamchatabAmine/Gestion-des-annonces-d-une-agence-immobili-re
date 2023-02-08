<?php 
require "connect.php";


// echo "<pre>";

// print_r($_GET);


// echo "</pre>";










if ($_SERVER["REQUEST_METHOD"] == "POST") :

    $titre = $_POST['annonceName'];
    // $image = $_FILES["fileToUpload"];
    $description = $_POST['annonceDesc'];
    $space = $_POST['annonceSpace']; 
    $adresse = $_POST['annonceLocation'];
    $price = $_POST['announcePrice'];
    $dateDannonce = $_POST['annonceDate'];
    $type = $_POST['category'];

    $image = $_FILES["fileToUpload"];
    
    $imageName = $_FILES["fileToUpload"]["name"]; 
    $imageType = $_FILES["fileToUpload"]["type"]; 
    $imageTmpName = $_FILES["fileToUpload"]["tmp_name"]; 
    $imageSize = $_FILES["fileToUpload"]["size"]; 
    $imageError = $_FILES["fileToUpload"]["error"]; 
    
    $errors = 1;
    
    $extension = array('jpg', 'jpeg','png', 'gif'); 
    
    $imageExtension = strtolower(end(explode('.', $imageName )));
    
    if($imageError ==4):
    
        echo "file is not opload";
    
    else:
    
        if (! in_array($imageExtension, $extension)) {
    
            $errors = 0 ;
    
        }
    
        if ( $_FILES["fileToUpload"]["size"] > 100000000) {
        
            $errors = 0; 
    
        }
    
        if ($errors == 0) {
    
            echo "Sorry, your file was not uploaded.";
    
        }else {
    
            move_uploaded_file($imageTmpName, $_SERVER['DOCUMENT_ROOT'] . '\annonce\images\\' . $imageName);
            echo $imageName . " is opload";

            $sql = "INSERT INTO `annonces` 
            (`titre`, `image`, `description`, `space`, `adresse`, `price`, `dateDannonce`, `type`) 
            VALUES 
            ('$titre' , '$imageName', '$description', $space, '$adresse', $price, $dateDannonce, '$type')";
            // execute a query
            $conn->query($sql)->fetch();

        }

    endif;


endif;



header("location:index.php");
