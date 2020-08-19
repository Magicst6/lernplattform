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
		
		let options2 = {
    "sScrollX": "100%",
    "sScrollXInner": "110%",
    "bScrollCollapse": true,
    "colReorder": true
		};
	
  var editor2; // use a global for the submit and return data rendering in the examples
 var table4;
	var table1;
	var table;
		var table4sm;
		var editor2sm;
	
		$(document).ready(function() {
		
 $(document).ready(function() {
    $('.datatables2').dataTable(options2);
});
		
			if(window.innerWidth>800){
			tableload2();
			}
			else{
				tableload3();
			}	
			

		});
	  function tableload2(){
		
    editor2 = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables2",
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
                     return '<a href="'+editor2.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor2.file( 'files', file_id ).web_path+'"</a>' ;                },
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
    $('.datatables2').on( 'click', 'tbody td:not(:first-child)', function (e) {
       
		
		var colIdx = table4
        .cell( this )
        .index().column;
		 var rowIdx = table4
        .cell( this )
        .index().row;
		
		if (colIdx == 2)
			{
				var r = confirm("Möchten Sie den gewählten Inhalt in die Textbox oben laden?");
if (r == true) {
    tinymce.get('lernproduktText').setContent(table4.cell(rowIdx,2).data() );
				
			
				document.getElementById("beschrT").value = table4.cell(rowIdx,1).data(); 
			r.destroy();	
} else {
  r.destroy();
} 
		
			}
    } );
		  
		
  $.fn.dataTable.ext.errMode = 'throw';
     table4 = $('.datatables2').DataTable( {
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
                       '<a href="'+editor2.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor2.file( 'files', file_id ).web_path+'" </a>' :
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
            { extend: "create", editor: editor2, text:"Neues Lernprodukt" },
            { extend: "edit",   editor: editor2, text:"Lernprodukt bearbeiten" },
            { extend: "remove", editor: editor2, text:"Lernprodukt löschen" },
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
		  function tableload3(){
			
			 editor2sm = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables2sm",
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
                     return '<a href="'+editor2sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor2sm.file( 'files', file_id ).web_path+'"</a>' ;                },
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
    $('.datatables2sm').on( 'click', 'tbody td:not(:first-child)', function (e) {
      
		
		  var colIdxsm = table4sm
        .cell( this )
        .index().column;
		 var rowIdxsm = table4sm
        .cell( this )
        .index().row;
		
		if (colIdxsm == 1)
			
		  {
				var r = confirm("Möchten Sie den gewählten Inhalt in die Textbox oben laden?");
if (r == true) {
    tinymce.get('lernproduktTextsm').setContent(table4sm.cell(rowIdxsm,1).data() );
				
			
				document.getElementById("beschrTsm").value = table4sm.cell(rowIdxsm,0).data(); 
	r.destroy();
				
} else {
  r.destroy();
} 
			}
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     table4sm = $('.datatables2sm').DataTable( {
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
                       '<a href="'+editor2sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor2sm.file( 'files', file_id ).web_path+'" </a>' :
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
            { extend: "create", editor: editor2sm, text:"Neuer Eintrag" },
            { extend: "edit",   editor: editor2sm, text:"Eintrag bearbeiten" },
            { extend: "remove", editor: editor2sm, text:"Eintrag löschen" },
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
		
		function showTable2() {
		
			
	if(window.innerWidth<800){
		
	
	

				document.getElementById("myModal2sm").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal2sm")) {
         document.getElementById("myModal2sm").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("span2sm").onclick = function() {
       document.getElementById("myModal2sm").style.display = "none";

    }
	}
	else {
			
			
				document.getElementById("myModal2").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal2")) {
         document.getElementById("myModal2").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("span2").onclick = function() {
       document.getElementById("myModal2").style.display = "none";

    }
	 }
     
		
		}
  function uploadT(){


            
		 var fd = new FormData();
        var text = tinyMCE.activeEditor.getContent();
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschrT = document.getElementById("beschrT").value;
	  
	  
	  
       fd.append('lpText',text);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschrT);


$.ajax({
            url: '/wp-content/plugins/Lernprodukte/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                   
                }else{
                    //alert('file not uploaded');
                }
            },
});
	  
	 myVarT = setTimeout(refreshTableT, 2000);
	  
	 

  }
     function refreshTableT(){
		  if ( table4 ) {
		table4.destroy();
	}
	
	if ( editor2 ) {
		editor2.destroy();
	}
		
		tableload2();
		 	alert('Aktion ausgeführt. Bitte überprüfen Sie den Upload in der Tabelle!');
  }
	 
		function uploadTsm(){


            
		 var fd = new FormData();
        var text = tinyMCE.activeEditor.getContent();
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschrTsm = document.getElementById("beschrTsm").value;
	  
	  
	  
        fd.append('lpText',text);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschrTsm);


$.ajax({
            url: '/wp-content/plugins/Lernprodukte/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                   
                }else{
                    //alert('file not uploaded');
                }
            },
});
	  
	 myVarTsm = setTimeout(refreshTableTsm, 2000);
  }
     function refreshTableTsm(){
		  if ( table4sm ) {
		table4sm.destroy();
	}
	
	if ( editor2sm ) {
		editor2sm.destroy();
	}
		
		tableload3();
		 	alert('Aktion ausgeführt. Bitte überprüfen Sie den Upload in der Tabelle!');
  }
	 
		
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>

<button id="showTable" onClick="showTable2()">Text hochladen</button>	
	
<input id="userid" type="hidden" value="<? echo $current_user->ID; ?>"	>
	
<div id="myModal2" class="modal1" >

    <!-- Modal content -->
    <div class="modal-content1">
		<span class="close"  id="span2">&times;</span>
		<h3>Hier können Sie Ihre Lernprodukte hochladen</h3>
		

		
<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrT" id="beschrT" type=text width=200px  required="required">
		<br><br>
		
		
		
    Schreiben Sie hier Ihren Text:*<br><br>
	 <input type="hidden" name="uid" id="uid" value="<? echo $current_user->ID;?>">		
			<input type="hidden" name="loginname" id="loginname" value="<? echo $current_user->user_login;?>">	
			<input type="hidden" name="EMail" id="EMail" value="<? echo $current_user->user_email;?>">	
			<input type="hidden" name="name" id="name" value="<? echo $current_user->user_lastname;?>">	
			<input type="hidden" name="vorname" id="vorname" value="<? echo $current_user->user_firstname;?>">	
			
    <textarea id="lernproduktText"  height="400px" ></textarea><br>
    <input type="button" value="Text hochladen" name="submit" onClick="uploadT()">

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
      <table class="table table-striped table-hover datatables2">
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
	
	<div id="myModal2sm" class="modal1" >

    <!-- Modal content -->
    <div class="modal-content1">
		<span class="close"  id="span2sm">&times;</span>
		<h3>Hier können Sie Ihre Lernprodukte hochladen</h3>
		<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrTsm" id="beschrTsm" type=text width=200px  required="required">
		<br><br>
		
		
		
    Schreiben Sie hier Ihren Text:*<br><br>
	
			
   <textarea id="lernproduktTextsm"  height="400px"  ></textarea><br>
     <input type="button" value="Text hochladen" name="submit8" onClick="uploadTsm()">
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
      <table class="table table-striped table-hover datatables2sm">
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
table.datatables2{
  table-layout:fixed;
}
	table.datatables2sm{
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