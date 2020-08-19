<html>


	
	
<!--
			<div class="demo-html width=50%"></div>
			<table id="example" class="display" style="width:50%">
				<thead>
					<tr>
						<th>Note</th>
						<th>Name</th>
						<th>Gewichtung</th>
						<th>Datum</th>
					</tr>
				</thead>
				
			</table>
			
</html>-->
	
	<script>
		let options1 = {
    "sScrollX": "100%",
    "sScrollXInner": "110%",
    "bScrollCollapse": true,
    "colReorder": true
		};
	
  var editor1; // use a global for the submit and return data rendering in the examples
 var table3;
	var table1;
	var table;
		var table3sm;
		var editor1sm;
	
		$(document).ready(function() {
		
 $(document).ready(function() {
    $('.datatables1').dataTable(options1);
});
			
			if(window.innerWidth>800){
			tableload();
			}
			else{
				tableload1();
			}	
			
	
			

		});
	  function tableload(){
		
    editor1 = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables1",
        fields: [ 
               
			
			 {
                label: "ID:",
                name: "ID"
            },
			{
                label: "Beschreibung:",
                name: "Beschreibung"	
            },
			{
                label: "Text:",
                name: "TEXT",
				type: "readonly"
            }, {
                label: "Datum:",
                name: "Datum",
				type: "readonly"
				
				
            },
			{
                label: "URL:",
                name: "URL",
				type: "readonly"
				
            }, 
			{
                label: "Kommentar:",
                name: "Kommentar",
				type: "readonly"
            },
			{
                label: "Nachname:",
                name: "Nachname",
				type: "hidden"
            },
			 {
               label: "Vorname:",
                name: "Vorname",
				type: "hidden"
			 }
			, {
                label: "User_ID:",
                name: "User_ID",
				type: "hidden"
            },
			 {
               label: "Loginname:",
                name: "Loginname"
			 },
			{
               label: "E-Mail:",
                name: "EMAIL",
				type: "hidden"
			 },
			{
                label: "Korrigierte Datei:",
                name: "Datei",
                type: "upload",
                display: function ( file_id ) {
                     return '<a href="'+editor1.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor1.file( 'files', file_id ).web_path+'"</a>' ;                },
                clearText: "Clear",
                noImageText: 'keine Datei',
				type: "readonly"
            }
		
        ],
		  i18n: {
            remove: {
                button: "Löschen",
                title:  "Eintrag löschen",
                submit: "Endgültig Löschen",
                confirm: {
                    _: 'Sind Sie sicher, dass Sie die %d ausgwählten Zeilen löschen wollen?',
                    1: 'Sind Sie sicher, dass Sie die ausgewählte Zeile löschen wollen?'
                }
            },
            edit: {
                button: "Bearbeiten",
                title:  "Eintrag bearbeiten",
                submit: "Änderungen speichern"
            },
            create: {
                button: "Neuer Eintrag",
                title:  "Neuen Eintrag anlegen",
                submit: "Neuen Eintrag speichern"
            },
            datetime: {
                    previous: 'Zurück',
                    next:     'Weiter',
                    months:   [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
                    weekdays: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
                    amPm:     [ 'am', 'pm' ],
                    unknown:  '-'
            },
            error: {            
                    system: "Ein Systemfehler ist aufgetreten (<a target=\"_blank\" href=\"//datatables.net/tn/12\">Für mehr Informationen</a>)."
            },
            multi: {
                    title: "Mehrere Werte",         
                    info: "Die ausgewählten Elemente enthalten verschiedene Werte für das Feld. Um alle Elemente für diess Feld auf den gleichen Wert zu setzen, klicken Sie bitte hier. Ansonsten werden die Elemente ihren jeweiligen Wert behalten.",
                    restore: "Änderungen rückgängig machen",
                    noMulti: "Dieses Feld kann einzeln bearbeitet werden, aber nicht als Teil einer Gruppe."
            },
        }      
    } );
 
    // Activate an inline edit on click of a table cell
    $('.datatables1').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor1.inline( this, {
            buttons: { label: '&gt;', fn: function () { this.submit(); } }
        } );
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     table3 = $('.datatables1').DataTable( {
		   "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        dom: "lBfrtip",
        ajax:     { 
			url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				
				'user': document.getElementById("userid").value
			
			}
        }, 
        order: [[ 3, 'desc' ]],
		  autoWidth: false,
        columns: [
       
			{ data: "ID"},
			{ data: "Beschreibung"},
			{ data: "TEXT"},
			
			{ data: "Datum"},
			{data: "URL", "name": "URL",
        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if(oData.URL) {
                $(nTd).html("<a href="+oData.URL+" target=”_blank”>"+oData.URL+"</a>");
            }
        }
			},
            { data: "Kommentar"},
			
			{
                data: "Datei",
                render: function ( file_id ) {
                    return file_id ?
                       '<a href="'+editor1.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor1.file( 'files', file_id ).web_path+'" </a>' :
                        null;
                },
                defaultContent: "keine Datei",
                title: "Korrektur"
            }
	
          
        ],

        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editor1, text:"Neues Lernprodukt" },
            { extend: "edit",   editor: editor1, text:"Lernprodukt bearbeiten" },
            { extend: "remove", editor: editor1, text:"Lernprodukt löschen" },
			 {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    } );
	  }
		  function tableload1(){
			
			 editor1sm = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables1sm",
        fields: [ 
               
			
			 {
                label: "ID:",
                name: "ID"
            },
			{
                label: "Beschreibung:",
                name: "Beschreibung"	
            },
			{
                label: "Text:",
                name: "TEXT",
				type: "textarea"
            }, {
                label: "Datum:",
                name: "Datum",
				type: "readonly"
				
				
            },
			{
                label: "URL:",
                name: "URL",
				type: "readonly"
				
            }, 
			{
                label: "Kommentar:",
                name: "Kommentar",
				type: "readonly"
            },
			{
                label: "Nachname:",
                name: "Nachname",
				type: "hidden"
            },
			 {
               label: "Vorname:",
                name: "Vorname",
				type: "hidden"
			 }
			, {
                label: "User_ID:",
                name: "User_ID",
				type: "hidden"
            },
			 {
               label: "Loginname:",
                name: "Loginname"
			 },
			{
               label: "E-Mail:",
                name: "EMAIL",
				type: "hidden"
			 },
			{
                label: "Korrigierte Datei:",
                name: "Datei",
                type: "upload",
                display: function ( file_id ) {
                     return '<a href="'+editor1sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor1sm.file( 'files', file_id ).web_path+'"</a>' ;                },
                clearText: "Clear",
                noImageText: 'keine Datei',
				type: "readonly"
            }
		
        ],
		  i18n: {
            remove: {
                button: "Löschen",
                title:  "Eintrag löschen",
                submit: "Endgültig Löschen",
                confirm: {
                    _: 'Sind Sie sicher, dass Sie die %d ausgwählten Zeilen löschen wollen?',
                    1: 'Sind Sie sicher, dass Sie die ausgewählte Zeile löschen wollen?'
                }
            },
            edit: {
                button: "Bearbeiten",
                title:  "Eintrag bearbeiten",
                submit: "Änderungen speichern"
            },
            create: {
                button: "Neuer Eintrag",
                title:  "Neuen Eintrag anlegen",
                submit: "Neuen Eintrag speichern"
            },
            datetime: {
                    previous: 'Zurück',
                    next:     'Weiter',
                    months:   [ 'Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember' ],
                    weekdays: [ 'So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa' ],
                    amPm:     [ 'am', 'pm' ],
                    unknown:  '-'
            },
            error: {            
                    system: "Ein Systemfehler ist aufgetreten (<a target=\"_blank\" href=\"//datatables.net/tn/12\">Für mehr Informationen</a>)."
            },
            multi: {
                    title: "Mehrere Werte",         
                    info: "Die ausgewählten Elemente enthalten verschiedene Werte für das Feld. Um alle Elemente für diess Feld auf den gleichen Wert zu setzen, klicken Sie bitte hier. Ansonsten werden die Elemente ihren jeweiligen Wert behalten.",
                    restore: "Änderungen rückgängig machen",
                    noMulti: "Dieses Feld kann einzeln bearbeitet werden, aber nicht als Teil einer Gruppe."
            },
        }      
    } );
 
    // Activate an inline edit on click of a table cell
    $('.datatables1sm').on( 'click', 'tbody td:not(:first-child)', function (e) {
        editor1sm.inline( this, {
            buttons: { label: '&gt;', fn: function () { this.submit(); } }
        } );
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     table3sm = $('.datatables1sm').DataTable( {
		   "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        dom: "lBfrtip",
        ajax:     { 
			url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				
				'user': document.getElementById("userid").value
			
			}
        }, 
        order: [[ 4, 'desc' ]],
		  autoWidth: false,
        columns: [
       
			
			{ data: "Beschreibung"},
			{ data: "TEXT"},
			
			
			{data: "URL", "name": "URL",
        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if(oData.URL) {
                $(nTd).html("<a href="+oData.URL+" target=”_blank”>"+oData.URL+"</a>");
            }
        }
			},
         
			{
                data: "Datei",
                render: function ( file_id ) {
                    return file_id ?
                       '<a href="'+editor1sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor1sm.file( 'files', file_id ).web_path+'" </a>' :
                        null;
                },
                defaultContent: "keine Datei",
                title: "Korrektur"
            },
	
          { data: "Datum"}
		
          
        ],
		 'columnDefs' : [
        //hide the second & fourth column
        { 'visible': false, 'targets': [4] }
   
        ],

        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editor1sm, text:"Neuer Eintrag" },
            { extend: "edit",   editor: editor1sm, text:"Eintrag bearbeiten" },
            { extend: "remove", editor: editor1sm, text:"Eintrag löschen" },
			 {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]
    } );

 
 
        }
		
		function showTable1() {
			
	if(window.innerWidth<800){
		
	
	

				document.getElementById("myModal1sm").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal1sm")) {
         document.getElementById("myModal1sm").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("span1sm").onclick = function() {
       document.getElementById("myModal1sm").style.display = "none";

    }
	}
	else {
			
			
				document.getElementById("myModal1").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal1")) {
         document.getElementById("myModal1").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("span1").onclick = function() {
       document.getElementById("myModal1").style.display = "none";

    }
	 }
      
		
		}
  function upload(){


            
		 var fd = new FormData();
        var files = $('#fileToUpload')[0].files[0];
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschr = document.getElementById("beschr").value;
	  
	  
	  
        fd.append('fileToUpload',files);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
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
	  
	 myVar = setTimeout(refreshTable, 2000);
  }
     function refreshTable(){
		  if ( table3 ) {
		table3.destroy();
	}
	
	if ( editor1 ) {
		editor1.destroy();
	}
		
		tableload();
		 	alert('Aktion ausgeführt. Bitte überprüfen Sie den Upload in der Tabelle!');
  }
	 
		function uploadsm(){


            
		 var fd = new FormData();
        var files = $('#fileToUploadsm')[0].files[0];
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschrsm = document.getElementById("beschrsm").value;
	  
	  
	  
        fd.append('fileToUpload',files);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschrsm);


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
	  
	 myVarsm = setTimeout(refreshTablesm, 2000);
  }
     function refreshTablesm(){
		  if ( table3sm ) {
		table3sm.destroy();
	}
	
	if ( editor1sm ) {
		editor1sm.destroy();
	}
		
		tableload1();
		 	alert('Aktion ausgeführt. Bitte überprüfen Sie den Upload in der Tabelle!');
  }
	 
		
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>

<button id="showTable" onClick="showTable1()">Datei hochladen</button>	
	
<input id="userid" type="hidden" value="<? echo $current_user->ID; ?>"	>
	
<div id="myModal1" class="modal1" >

    <!-- Modal content -->
    <div class="modal-content1">
		<span class="close"  id="span1">&times;</span>
		<h3>Hier können Sie Ihre Lernprodukte hochladen</h3>
		

		
<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschr" id="beschr" type=text  width=200px  required="required">
		<br><br>
		
		
		
    Wählen Sie die hochzuladende Datei aus:*<br><br>
	 <input type="hidden" name="uid" id="uid" value="<? echo $current_user->ID;?>">		
			<input type="hidden" name="loginname" id="loginname" value="<? echo $current_user->user_login;?>">	
			<input type="hidden" name="EMail" id="EMail" value="<? echo $current_user->user_email;?>">	
			<input type="hidden" name="name" id="name" value="<? echo $current_user->user_lastname;?>">	
			<input type="hidden" name="vorname" id="vorname" value="<? echo $current_user->user_firstname;?>">	
			
    <input type="file" name="fileToUpload" id="fileToUpload" required="required"><br>
    <input type="button" value="Datei hochladen" name="submit" onClick="upload()">

</form>
<br><br>



<br><br>

<h1>Lernprodukte</h1>
<div class="container">
  <div class="row">
    <form class="col-md4"></form>
  </div>
  <div class="row">
    <div class="col md12">
      <table class="table table-striped table-hover datatables1">
        <thead>
          <tr>
           
            <th class="small-col1">ID</th>
			  <th class="norm-col1">Beschreibung</th>
            <th class="big-col1">TEXT</th>
			<th class="norm-col1">Datum</th>
	        <th class="norm-col1">URL</th>
			<th class="norm-col1">Kommentar</th>
			   <th class="norm-col1">Korrekturdatei</th>
		  
			<!-- <th>Datei</th> -->
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

		
	</div>
	</div>
	
	<div id="myModal1sm" class="modal1" >

    <!-- Modal content -->
    <div class="modal-content1">
		<span class="close"  id="span1sm">&times;</span>
		<h3>Hier können Sie Ihre Lernprodukte hochladen</h3>
		<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrsm" id="beschrsm" width=200px  type=text required="required">
		<br><br>
		
		
		
    Wählen Sie die hochzuladende Datei aus:*<br><br>
	
			
    <input type="file" name="fileToUploadsm" id="fileToUploadsm" required="required"><br>
     <input type="button" value="Datei hochladen" name="submit1" onClick="uploadsm()">
</form>
<br><br>



<br><br>

<h1>Lernprodukte</h1>
<div class="container">
  <div class="row">
    <form class="col-md4"></form>
  </div>
  <div class="row">
    <div class="col md12">
      <table class="table table-striped table-hover datatables1sm">
        <thead>
          <tr>
           
           
			  <th class="norm-col1sm">Beschreibung</th>
			  <th class="big-col1sm">TEXT</th>
	        <th class="norm-col1sm">URL</th>
			   <th class="norm-col1sm">Korrekturdatei</th>
		  
			<!-- <th>Datei</th> -->
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>

		
	</div>
	</div>

	
</form>&nbsp;
<style>
		 button {
     	background-color:#e91e63;
	border-radius:28px;
	border:0x solid #18ab29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-size:17px;
	padding:16px 31px;
	text-decoration:none;
	box-shadow: 3px 3px 3px grey;	 
}button:hover {
	background-color: #18ab29;
}
button:active {
	position:relative;
	top:1px;
		 
        }
	
	
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
         
		.modal1{
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
       
		
		.modal-content1 {
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