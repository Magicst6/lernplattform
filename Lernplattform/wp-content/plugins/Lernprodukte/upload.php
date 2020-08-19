<?php


$uid=$_POST['uid'];
$login=$_POST['loginname'];
$mail=$_POST['EMail'];
$name=$_POST['name'];
$vorname=$_POST['vorname'];
$beschr=$_POST['beschr'];
$Text=$_POST['lpText'];
$komment=$_POST['komment'];
$ID=$_POST['ID'];
$Bewertung=$_POST['bew'];



echo $ID;

if($ID){
	include('db.php');
	 $sql_befehlT = "UPDATE Lernprodukte SET TEXT='$Text', Kommentar='$komment',Beschreibung='$beschr', Bewertung='$Bewertung' Where ID='$ID'";
    
mysqli_query($con,$sql_befehlT);
	
}else{
	

$target_dir = "uploads/";
	$file  = str_replace(' ', '',$_FILES["fileToUpload"]["name"]);

$target_file = $target_dir . basename(date("d.m.Y-H:i:s",time()).$file);


if ($_FILES["fileToUpload"]["name"]){

$uploadOk = 1;

$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

echo $target_file;

//echo $FileType;

// Check if file already exists

if (file_exists($target_file)) {

    echo "Sorry, file already exists.";

    $uploadOk = 0;

}

// Check file size

if ($_FILES["fileToUpload"]["size"] > 5000000) {

    echo "Sorry, your file is too large.";

    $uploadOk = 0;

}

// Allow certain file formats

if($FileType != "pdf" && $FileType != "jpg" && $FileType != "jpeg" && $FileType != "png"  && $FileType != "xlsx" && $FileType != "docx" && $FileType != "pptx" && $FileType != "xls" && $FileType != "doc" && $FileType != "ppt"  ) {

    echo "Sorry, this file type is not allowed.";

    $uploadOk = 0;

}

// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {

    echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file

} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

    } else {

        echo "Sorry, there was an error uploading your file.";

    }


}


$targetURL="/wp-content/plugins/Lernprodukte/".$target_file;

echo  '<a href='.$targetURL.'>Link</a>';
	include('db.php');

$datum=date("Y-m-d H:i:s");



	

    $sql_befehl2 = "INSERT INTO Lernprodukte (Datum,User_ID,URL,Vorname,Nachname,Loginname,EMAIL,Beschreibung,TEXT ) VALUES ('$datum','$uid','$targetURL','$vorname','$name','$login','$mail','$beschr','$Text')";
    
mysqli_query($con,$sql_befehl2);
}
else{
	
if($Text){

include('db.php');

$datum=date("Y-m-d H:i:s");



	

    $sql_befehl2 = "INSERT INTO Lernprodukte (Datum,User_ID,URL,Vorname,Nachname,Loginname,EMAIL,Beschreibung,TEXT ) VALUES ('$datum','$uid','$targetURL','$vorname','$name','$login','$mail','$beschr','$Text')";
    
mysqli_query($con,$sql_befehl2);
}
}
}
//header('Location:'.$_SERVER['HTTP_REFERER']);


