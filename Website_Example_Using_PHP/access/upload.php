<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>
    <body>
        <?php
        try {

            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (!isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error'])) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $_FILES['upfile']['error'] value.
            switch ($_FILES['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }
            // Check filesize here. measured in bytes 
            if ($_FILES['upfile']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $validExts = array(
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif',
            );
            //get the file extension using the temp name(tmp_name) places the file in a 
            $ext = array_search($finfo->file($_FILES['upfile']['tmp_name']), $validExts, true);

            if (false === $ext) {
                throw new RuntimeException('Invalid file format.');
            }
            //sha1 encryption for the image filename
            $fileName = sha1_file($_FILES['upfile']['tmp_name']);
            //sprintf is a c++ function that tells the website where to save the file to    
            $location = sprintf('./images/%s.%s', $fileName, $ext);
            //if this directory doesnt exist then create it
            if (!is_dir('./images')) {
                mkdir('./images');
            }
            //this takes the temp file and moves it to the desired location/filepath specified

            if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $location)) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

            echo 'File is uploaded successfully.';
        } catch (RuntimeException $e) {

            echo $e->getMessage();
        }
        ?>
    </body>
</html>