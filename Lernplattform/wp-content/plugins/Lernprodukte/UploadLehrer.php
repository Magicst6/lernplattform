<script>
function test2(){
	var uid = document.getElementById("Schueler").value;
	var patt = /:(.*)/;
  var result = uid.match(patt);  
	
	alert(result[1]);
}
</script>
<?
include('db.php');



?>



<br>


<script>
	
	function showTable1() {
			
	
			
			
				document.getElementById("myModalUL").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModalUL")) {
         document.getElementById("myModalUL").style.display = "none";
			location.reload();
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("spanUL").onclick = function() {
       document.getElementById("myModalUL").style.display = "none";
		 location.reload();

    }
	 }
      
		
		
	
function test2(){
	var uid = document.getElementById("Schueler").value;
	var patt = /:(.*)/;
  var result = uid.match(patt);  
	
	alert(result);
}

function upload(){

	

            
		 var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
	  var loginname =document.getElementById("loginname").value;
	  var EMail ='';
	  
	  var name = '';
	  var vorname = '';
	   var beschr = document.getElementById("beschr").value;
	  
	
 var uid = document.getElementById("Schueler").value;
	var patt = /:(.*)/;
  var uid = uid.match(patt);  
	
	var loginname = document.getElementById("Schueler").value;
	var patt1 = /(.*)ID:/;
    var login = loginname.match(patt1);  
	var login=login[1]+' - von LP';
	
	beschr=beschr+ ' von LP hochgeladen';
	  
        fd.append('fileToUpload',files);
	   fd.append('uid',uid[1]);
	  fd.append('loginname',login);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschr);


$.ajax({
            url: '/wp-content/plugins/Lernprodukte/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                   
                }else{
                    alert('file not uploaded');
                }
            },
});
	  
	alert('Aktion ausgeführt!'); 
	
	
  }
    
	 
		
	 
	
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>


	

	


    <!-- Modal content -->
   
		
<button id="showTable" onClick="showTable1()">Datei für einen Schüler hochladen</button>	
	

	
<div id="myModalUL" class="modalUL" >

    <!-- Modal content -->
    <div class="modal-contentUL">
		<span class="close"  id="spanUL">&times;</span>		
		
		<h3>Hier können Sie Dateien für den gewählten Schüler hochladen</h3>

<br>


 Für Schüler hochladen:

    <br>

    <select name="Schueler"  id="Schueler"  >



        <?php

        $isEntry= "Select * From wp_users";

        $result = mysqli_query($con1, $isEntry);

       

        echo "<option>".''. "</option>";

        while( $line2= mysqli_fetch_array($result))

        {

            $ID = $line2['ID'];

            $Name = $line2['display_name'];

           





            echo "<option>".$Name.'  ID:'. $ID."</option>";
			
		

        }

        ?>





    </select>
		
		<br>

		
<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschr" id="beschr" type=text  width=200px  required="required">
		<br><br>
		
		
		
    Wählen Sie die hochzuladende Datei aus:*<br><br>
	
			<input type="hidden" name="loginname" id="loginname" value="<? echo $current_user->user_login;?>">	
			<input type="hidden" name="EMail" id="EMail" value="<? echo $current_user->user_email;?>">	
			<input type="hidden" name="name" id="name" value="<? echo $current_user->user_lastname;?>">	
			<input type="hidden" name="vorname" id="vorname" value="<? echo $current_user->user_firstname;?>">	
			
    <input type="file" name="fileToUpload" id="fileToUpload" required="required"><br>
    <input type="button" value="Datei hochladen" name="submit" onClick="upload()">

</form>
<br><br>
		
	</div>
</div>
			
	</style>
<style>
        body {}

	.big-col1 {
  width: 20% !important;
}
	.norm-col1 {
  width: 10% !important;
}
	.big-col1sm {
  width: 14% !important;
}
	.norm-col1sm {
  width: 8% !important;
}

		.small-col1 {
  width: 5% !important;
}
table.datatables1{
  table-layout:fixed;
}
	table.datatables1sm{
  table-layout:fixed;
}
         
		.modalUL{
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 70px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }


        /* Modal Content */
       
		
		.modal-contentUL {
            background-color: #fefefe;
            margin: auto;
            padding: 10px;
            border: 1px solid #888;
            max-width: 1200px;
			border-radius: 7px !important; 
			width: 98%; /* Full width */
           height:auto;
}
        }



        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        button {
          color: white;
        }
    </style>



