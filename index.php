<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submission 2 Dicoding</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="jquery.min.js"></script>
</head>
<body>
<script type="text/javascript">
    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************
 
        // Replace <Subscription Key> with your valid subscription key.
        var subscriptionKey = "30bfb94645ce48108364125116453c40";
 
        // You must use the same Azure region in your REST API method as you used to
        // get your subscription keys. For example, if you got your subscription keys
        // from the West US region, replace "westcentralus" in the URL
        // below with "westus".
        //
        // Free trial subscription keys are generated in the "westus" region.
        // If you use a free trial subscription key, you shouldn't need to change
        // this region.
        var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
 
        // Request parameters.
        var params = {
            "visualFeatures": "Categories,Description,Color",
            "details": "",
            "language": "en",
        };
 
        // Display the image.
        var sourceImageUrl = document.getElementById("inputImage").value;
        document.querySelector("#sourceImage").src = sourceImageUrl;
 
        // Make the REST API call.
        $.ajax({
            url: uriBase + "?" + $.param(params),
 
            // Request headers.
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader(
                    "Ocp-Apim-Subscription-Key", subscriptionKey);
            },
 
            type: "POST",
 
            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })
 
        .done(function(data) {
            // Show formatted JSON on webpage.
            $("#responseTextArea").val(JSON.stringify(data, null, 2));
        })
 
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Display error message.
            var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
            errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
            alert(errorString);
        });
    };
</script>

<?php 
if(isset($_POST['upload'])) {
    date_default_timezone_set('Asia/Jakarta');
    $name        = $_POST['gambar'];
    $time        = time();
    $nama_gambar = $_FILES['gambar'] ['name']; // Nama Gambar
    $size        = $_FILES['gambar'] ['size'];// Size Gambar
    $error       = $_FILES['gambar'] ['error'];
    $tipe_video  = $_FILES['gambar'] ['type']; //tipe gambar untuk filter
    $folder      = "uploads/"; //folder tujuan upload
    $valid       = array('jpg','png','gif','jpeg'); //Format File yang di ijinkan Masuk ke server
    
    if(strlen($nama_gambar))

       {   

         // Perintah untuk mengecek format gambar

         list($txt, $ext) = explode(".", $nama_gambar);

         if(in_array($ext,$valid))

         {   

           // Perintah untuk mengecek size file gambar

           if($size<500000)

           {   

             // Perintah untuk mengupload gambar dan memberi nama baru

             $gambarnya = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
             $gmbr  = $folder.$gambarnya;
             
             $tmp = $_FILES['gambar']['tmp_name'];

             if(move_uploaded_file($tmp, $folder.$gambarnya))

             {   
              $mysqli->query("INSERT INTO gallery_gambar(Nama_Gambar`, `DESC_GAMBAR`, `gambar`) VALUES ('$name', '$desc', '$gmbr') ");
              echo '<script>
                  alert("gambar Berhasil di upload");
               </script>';

             }
                else{ // Jika Gambar Gagal Di upload 
            echo '<script>
                  alert("gambar Gagal di upload");
               </script>';
            }
            
           }
           else{ // Jika Gambar melebihi size 
           echo '<script>
                  alert("gambar Terlalu Besar, Max 5MB");
               </script>';  
             }         

         }

         else{ // Jika File Gambar Yang di Upload tidak sesuai eksistensi yang sudah di tetapkan
            echo '<script>
                  alert("Format Gambar Tidak valid , Format Gambar Harus (JPG, Jpeg, gif, png) ");
               </script>';  
             }

       }         

       else{ // Jika Gambar belum di pilih 
        echo '<script>
                  alert("Gambar Belum Di Pilih , Harap Memilih Gambar Dahulu");
               </script>'; 
          }       

       exit;

     }
?>

<h1>Fitur upload file to storage:</h1>
<br />
<form action ="upload_file.php" metode="post" enctype="multipart/form-data">
    <label for="file"> Filename: </label>
    <input type="file" name="gambar" id="gambar" />
    <br />
    <input type="submit" name="upload" value="Submit" />
</form>
<p>


<h1>Fitur Vision:</h1>
Enter the URL to an image, then click the <strong>Analyze image</strong> button.
<br><br>
Image to analyze:
<input type="text" name="inputImage" id="inputImage"
    value="http://upload.wikimedia.org/wikipedia/commons/3/3c/Shaki_waterfall.jpg" />
<button onclick="processImage()">Analyze image</button>
<br><br>
<div id="wrapper" style="width:1020px; display:table;">
    <div id="jsonOutput" style="width:600px; display:table-cell;">
        Response:
        <br><br>
        <textarea id="responseTextArea" class="UIInput"
                  style="width:580px; height:400px;"></textarea>
    </div>
    <div id="imageDiv" style="width:420px; display:table-cell;">
        Source image:
        <br><br>
        <img id="sourceImage" width="400" />
    </div>
</div>


</body>
</html>