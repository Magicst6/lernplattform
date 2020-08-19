<html>


	
	<head>



	<link rel="stylesheet" type="text/css" href="/Datatables/DataTables-1.10.19/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="/Datatables/DataTables-1.10.19/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="/Datatables/DataTablesEditor/css/editor.dataTables.min.css">
	<!--	<link rel="stylesheet" type="text/css" href="/Datatables/DataTables-1.10.19/examples/resources/demo.css">-->
	<style type="text/css" class="init">

	</style>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" language="javascript" src="/Datatables/DataTables-1.10.19/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="/Datatables/DataTables-1.10.19/examples/resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="/Datatables/DataTables-1.10.19/examples/resources/demo.js"></script>
	<script type="text/javascript" language="javascript" src="/Datatables/DataTablesEditor/js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
	
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>


	
	
		<script src="https://cdn.tiny.cloud/1/p4y59yu91l1ttdi8h066ovomyunbzi9p44zqccnlmn9ly5ge/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

   <script>
		tinymce.init({
        selector: '#lernproduktText',
		  readonly : 0,
		  menubar: false,
		  height:600
      });
		tinymce.init({
        selector: '#lernproduktTextsm',
		  readonly : 0,
		  menubar: false,
		  height:600
      });
	   
		</script>
	
</head>

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
		
		
		
		
		
		let options3 = {
    "sScrollX": "100%",
    "sScrollXInner": "110%",
    "bScrollCollapse": true,
    "colReorder": true
		};
	
  var editor3; // use a global for the submit and return data rendering in the examples
 var table5;
	var table1;
	var table;
		var table5sm;
		var editor3sm;
	
		$(document).ready(function() {
	
		
 $(document).ready(function() {
    $('.datatables3').dataTable(options3);
});
	tableload4();
			tableload5();

		
			
		});
	  function tableload4(){
		 
		
    editor3 = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables3",
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
                     return '<a href="'+editor3.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor3.file( 'files', file_id ).web_path+'"</a>' ;                },
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
    $('.datatables3').on( 'click', 'tbody td:not(:first-child)', function (e) {
       
		
		var colIdx1 = table5
        .cell( this )
        .index().column;
		 var rowIdx1 = table5
        .cell( this )
        .index().row;
		
		if (colIdx1 == 2)
			{
				var r = confirm("Möchten Sie den gewählten Inhalt in die Textbox oben laden?");
if (r == true) {
    tinymce.get('lernproduktText1').setContent(table5.cell(rowIdx1,2).data() );
				
			
				document.getElementById("beschrT1").value = table5.cell(rowIdx1,1).data(); 
				
} else {
  
} 
		
			}
    } );
		  
		
  $.fn.dataTable.ext.errMode = 'throw';
     table5 = $('.datatables3').DataTable( {
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
        order: [[ 1, 'asc' ]],
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
                       '<a href="'+editor3.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor3.file( 'files', file_id ).web_path+'" </a>' :
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
            { extend: "remove", editor: editor2, text:"Lernprodukt löschen" }
        ]
    } );
	  }
		  function tableload3(){
			
			 editor3sm = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPUEdit.php",
            type: 'POST',
            data: {
                  
				'user': document.getElementById("userid").value
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables3sm",
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
                     return '<a href="'+editor3sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor3sm.file( 'files', file_id ).web_path+'"</a>' ;                },
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
    $('.datatables3sm').on( 'click', 'tbody td:not(:first-child)', function (e) {
      
		
		  var colIdx1sm = table5sm
        .cell( this )
        .index().column;
		 var rowIdx1sm = table5sm
        .cell( this )
        .index().row;
		
		if (colIdx1sm == 1)
			
		  {
				var r = confirm("Möchten Sie den gewählten Inhalt in die Textbox oben laden?");
if (r == true) {
    tinymce.get('lernproduktText1sm').setContent(table5sm.cell(rowIdx1sm,1).data() );
				
			
				document.getElementById("beschrT1sm").value = table4sm.cell(rowIdx1sm,0).data(); 
				
} else {
  
} 
			}
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     table5sm = $('.datatables3sm').DataTable( {
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
        order: [[ 1, 'asc' ]],
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
                       '<a href="'+editor3sm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor3sm.file( 'files', file_id ).web_path+'" </a>' :
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
            { extend: "create", editor: editor3sm, text:"Neuer Eintrag" },
            { extend: "edit",   editor: editor3sm, text:"Eintrag bearbeiten" },
            { extend: "remove", editor: editor3sm, text:"Eintrag löschen" }
        ]
    } );

			  
			  
 
 
        }
		
		
  function uploadT1(){


            
		 var fd = new FormData();
        var text = tinyMCE.activeEditor.getContent();
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschrT1 = document.getElementById("beschrT1").value;
	  
	  
	  
       fd.append('lpText',text);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschrT1);


$.ajax({
            url: 'https://lernplattform.schulverwaltungheimtest.ch/wp-content/plugins/Lernprodukte/upload.php',
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
	  
	 myVarT1 = setTimeout(refreshTableT1, 2000);
	  
	 

  }
     function refreshTableT1(){
		  if ( table5 ) {
		table5.destroy();
	}
	
	if ( editor3 ) {
		editor3.destroy();
	}
		
		tableload4();
  }
	 
		function uploadT1sm(){


            
		 var fd = new FormData();
        var text = tinyMCE.activeEditor.getContent();
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschrT1sm = document.getElementById("beschrT1sm").value;
	  
	  
	  
        fd.append('lpText',text);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschrT1sm);


$.ajax({
            url: 'https://lernplattform.schulverwaltungheimtest.ch/wp-content/plugins/Lernprodukte/upload.php',
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
	  
	 myVarT1sm = setTimeout(refreshTableT1sm, 2000);
  }
     function refreshTableT1sm(){
		  if ( table5sm ) {
		table5sm.destroy();
	}
	
	if ( editor3sm ) {
		editor3sm.destroy();
	}
		
		tableload5();
  }
	 
		
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>


<input id="userid" type="hidden" value="<? echo $current_user->ID; ?>"	>
	
<div id="myModal4"   style="display: none" >

    <!-- Modal content -->
    
		
		<h3>Hier können Sie ihre Lernprodukte hochladen</h3>
		

		
<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrT1" id="beschrT1"  width=100px  required="required">
		<br><br>
		
		
		
    Schreiben Sie hier Ihren Text:*<br><br>
	 <input type="hidden" name="uid" id="uid" value="<? echo $current_user->ID;?>">		
			<input type="hidden" name="loginname" id="loginname" value="<? echo $current_user->user_login;?>">	
			<input type="hidden" name="EMail" id="EMail" value="<? echo $current_user->user_email;?>">	
			<input type="hidden" name="name" id="name" value="<? echo $current_user->user_lastname;?>">	
			<input type="hidden" name="vorname" id="vorname" value="<? echo $current_user->user_firstname;?>">	
			
    <textarea id="lernproduktText1"  height="400px" ></textarea><br>
    <input type="button" value="Text hochladen" name="submit2" onClick="uploadT1()">

</form>
<br><br>



	</div>

	
	<div id="myModal4sm" style="display: block"  >

    <!-- Modal content -->
    
		
		<h3>Hier können Sie ihre Lernprodukte hochladen</h3>
		<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrT1sm" id="beschrT1sm" width=100px  required="required">
		<br><br>
		
		
		
    Schreiben Sie hier Ihren Text:*<br><br>
	
			
   <textarea id="lernproduktText1sm"  height="400px"  ></textarea><br>
     <input type="button" value="Text hochladen" name="submit3" onClick="uploadT1sm()">
</form>
<br><br>




		
	</div>
	
<script>
	
		
  function upload1(){


            
		 var fd = new FormData();
        var files = $('#fileToUpload1')[0].files[0];
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschr1 = document.getElementById("beschr1").value;
	  
	  
	  
        fd.append('fileToUpload',files);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschr1);


$.ajax({
            url: 'https://lernplattform.schulverwaltungheimtest.ch/wp-content/plugins/Lernprodukte/upload.php',
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
	  
	 myVar1 = setTimeout(refreshTable1, 2000);
  }
     function refreshTable1(){
		  if ( table5 ) {
		table5.destroy();
	}
	
	if ( editor3 ) {
		editor3.destroy();
	}
		
		tableload4();
  }
	
	 
		function upload1sm(){


            
		 var fd = new FormData();
        var files = $('#fileToUpload1sm')[0].files[0];
	  var loginname =document.getElementById("loginname").value;
	  var EMail = document.getElementById("EMail").value;
	  var uid = document.getElementById("uid").value;
	  var name = document.getElementById("name").value;
	  var vorname = document.getElementById("vorname").value;
	   var beschr1sm = document.getElementById("beschr1sm").value;
	  
	  
	  
        fd.append('fileToUpload',files);
	   fd.append('uid',uid);
	  fd.append('loginname',loginname);
	  fd.append('EMail',EMail);
	  fd.append('name',name);
	  fd.append('vorname',vorname);
	   fd.append('beschr',beschr1sm);


$.ajax({
            url: 'https://lernplattform.schulverwaltungheimtest.ch/wp-content/plugins/Lernprodukte/upload.php',
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
	  
	 myVarsm1 = setTimeout(refreshTable1sm, 2000);
  }
     function refreshTable1sm(){
		  if ( table5sm ) {
		table5sm.destroy();
	}
	
	if ( editor3sm ) {
		editor3sm.destroy();
	}
		
		tableload5();
  }
	 
		function showTable6() {
			
		alert();
			//document.getElementById("beschr1").value= "block"; 
		
	
		
		
		}
		
		
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>
	

	
<input id="userid" type="hidden" value="<? echo $current_user->ID; ?>"	>
	
<div id="myModal5"  style="display:none">  

    <!-- Modal content -->
  
		
		<h3>Hier können Sie ihre Lernprodukte hochladen</h3>
		

		
<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschr1" id="beschr1"  width=100px  required="required">
		<br><br>
		
		
		
    Wählen Sie die hochzuladende Datei aus:*<br><br>
	 <input type="hidden" name="uid" id="uid" value="<? echo $current_user->ID;?>">		
			<input type="hidden" name="loginname" id="loginname" value="<? echo $current_user->user_login;?>">	
			<input type="hidden" name="EMail" id="EMail" value="<? echo $current_user->user_email;?>">	
			<input type="hidden" name="name" id="name" value="<? echo $current_user->user_lastname;?>">	
			<input type="hidden" name="vorname" id="vorname" value="<? echo $current_user->user_firstname;?>">	
			
    <input type="file" name="fileToUpload1" id="fileToUpload1" required="required"><br>
    <input type="button" value="Datei hochladen" name="submit" onClick="upload1()">

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
      <table class="table table-striped table-hover datatables3">
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
	
	<div id="myModal5sm"  style="display: block"  width=100%>
    <!-- Modal content -->
   
		
		<h3>Hier können Sie ihre Lernprodukte hochladen</h3>
		<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschr1sm" id="beschr1sm" width=100px  required="required">
		<br><br>
		
		
		
    Wählen Sie die hochzuladende Datei aus:*<br><br>
	
			
    <input type="file" name="fileToUpload1sm" id="fileToUpload1sm" required="required"><br>
     <input type="button" value="Datei hochladen" name="submit1" onClick="upload1sm()">
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
      <table class="table table-striped table-hover datatables3sm">
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

	
	
</form>&nbsp;
<style>
	 button {
          color: white;
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
table.datatables3{
  table-layout:fixed;
}
	table.datatables3sm{
  table-layout:fixed;
}
         
		.modal{
            /* Hidden by default */
           
        }
	.modalsm{
           /* Hidden by default */
          
        }



        /* Modal Content */
       
		
	



        /* The Close Button */
      
        button {
          color: white;
        }
    </style>