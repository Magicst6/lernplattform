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
	

		
	let options = {
    "sScrollX": "100%",
    "sScrollXInner": "110%",
    "bScrollCollapse": true,
    "colReorder": true
};
  var editor; // use a global for the submit and return data rendering in the examples
 var table2;
	var table1;
	var table;
		var tablesm;
		 var rksm="";
		 var rk="";
		 var editorsm;
  $( document ).ready(function() {
    


$(document).ready(function() {
    $('.datatables').dataTable(options);
});
	       


			
				  tableloadK();
		
					  tableloadKsm();
				
			
	  });
	  
	  
		function tableloadK(){
    editor = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPEdit.php",
            type: 'POST',
            data: {
                  
				
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatables",
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
            }, 
			{
                label: "Kommentar:",
                name: "Kommentar",
				type: "textarea"
            },
			{
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
                    return  '<a href="'+editor.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor.file( 'files', file_id ).web_path+'"</a>';
                },
                clearText: "Clear",
                noImageText: 'keine Datei'
            },
			{
               label: "Bewertung:",
                name: "Bewertung"
			
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
    $('.datatables').on( 'click', 'tbody td:not(:first-child)', function (e) {
       rk='';
					var colIdxK = table2
        .cell( this )
        .index().column;
		 var rowIdxK = table2
        .cell( this )
        .index().row;
		
		if (colIdxK == 2 && !rk)
			{
				
			
      tinymce.get('lernproduktTextkorr').setContent(table2.cell(rowIdxK,2).data() );
	   tinymce.get('komment').setContent(table2.cell(rowIdxK,5).data() );
	document.getElementById("bew").value = table2.cell(rowIdxK,8).data(); 
				document.getElementById("beschrTK").value = table2.cell(rowIdxK,1).data(); 
	document.getElementById("myModalT").style.display = 'block'; 
	 window.onclick = function(event) {
        if (event.target == document.getElementById("myModalT")) {
         document.getElementById("myModalT").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("spanT").onclick = function() {
       document.getElementById("myModalT").style.display = "none";
		 
	
    }
	 
	

	
	
	
				

		
			}
       
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     table2 = $('.datatables').DataTable( {
		   "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        dom: "lBfrtip",
        ajax:     { 
			url: "/Datatables/DataTablesEditor/AjaxScripts/getLPEdit.php",
            type: 'POST',
            data: {
                  
				
				
			
			}
        }, 
        order: [[ 3, 'desc' ]],
		 autoWidth: false,
		 responsive:true,
        columns: [
         
			
			{ data: "ID"},
			{ data: "Beschreibung"},
			{ data: "TEXT"},
			{ data: "Datum"},
			{data: "URL", "name": "URL","innerWidth": "10%",
        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if(oData.URL) {
                $(nTd).html("<a href="+oData.URL+" target=”_blank”>"+oData.URL+"</a>");
            }
        },
			
			},
 			{ data: "Kommentar"},
		
			{
                data: "Datei",
                render: function ( file_id ) {
                    return file_id ?
                        '<a href="'+editor.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor.file( 'files', file_id ).web_path+'"</a>' :
                        null;
                },
                defaultContent: "keine Datei",
                title: "Korrektur"
            },
	
          	{ data: "Loginname" },
			{data: "Bewertung"}
        ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editor, text:"Neues Lernprodukt" },
            { extend: "edit",   editor: editor, text:"Lernprodukt bearbeiten" },
            { extend: "remove", editor: editor, text:"Lernprodukt löschen" },
			   
             
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
 
      function tableloadKsm(){
			
	   editorsm = new $.fn.dataTable.Editor( {
        ajax: { url: "/Datatables/DataTablesEditor/AjaxScripts/getLPEdit.php",
            type: 'POST',
            data: {
                  
				
				
			}
        },
		  language: {
            "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        table: ".datatablessm",
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
            }, 
			{
                label: "Kommentar:",
                name: "Kommentar",
				type: "textarea"
            },
			{
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
                    return  '<a href="'+editor.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editor.file( 'files', file_id ).web_path+'"</a>';
                },
                clearText: "Clear",
                noImageText: 'keine Datei'
            },
			{
               label: "Bewertung:",
                name: "Bewertung"
			
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
 
	  
		
		$('.datatablessm').on( 'click', 'tbody td:not(:first-child)', function (e) {
       
							var colIdxKsm = tablesm
        .cell( this )
        .index().column;
		 var rowIdxKsm = tablesm
        .cell( this )
        .index().row;
		
		if (colIdxKsm == 1 && !rksm)
			{
				
			
    tinymce.get('lernproduktTextkorr').setContent(table2.cell(rowIdxKsm,2).data() );
				 tinymce.get('komment').setContent(table2.cell(rowIdxKsm,5).data() );
			document.getElementById("ID").value = table2.cell(rowIdxKsm,0).data(); 
				document.getElementById("beschrTK").value = table2.cell(rowIdxKsm,1).data(); 
				document.getElementById("bew").value = table2.cell(rowIdxKsm,8).data(); 
				 
	document.getElementById("myModalT").style.display = 'block'; 
	 window.onclick = function(event) {
        if (event.target == document.getElementById("myModalT")) {
         document.getElementById("myModalT").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("spanT").onclick = function() {
       document.getElementById("myModalT").style.display = "none";
		 
	
    }
	 
	
	
	
	
	  
				

		
			}
    } );
  $.fn.dataTable.ext.errMode = 'throw';
     tablesm = $('.datatablessm').DataTable( {
		   "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/German.json"
        },
        dom: "lBfrtip",
        ajax:     { 
			url: "/Datatables/DataTablesEditor/AjaxScripts/getLPEdit.php",
            type: 'POST',
            data: {
                  
				
				
			
			}
        }, 
        order: [[ 6, 'desc' ]],
		 autoWidth: false,
		 responsive:true,
        columns: [
         
			
		
			{ data: "Beschreibung"},
			{ data: "TEXT"},
			
			{data: "URL", "name": "URL","innerWidth": "10%",
        fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
            if(oData.URL) {
                $(nTd).html("<a href="+oData.URL+" target=”_blank”>"+oData.URL+"</a>");
            }
        },
			
			},
 			
		
			{
                data: "Datei",
                render: function ( file_id ) {
                    return file_id ?
                        '<a href="'+editorsm.file( 'files', file_id ).web_path+'" target=”_blank”>"'+editorsm.file( 'files', file_id ).web_path+'"</a>' :
                        null;
                },
                defaultContent: "keine Datei",
                title: "Korrektur"
            },
				{ data: "Loginname" },
			{ data: "Bewertung" },
			{ data: "Datum"},
		
          
        ],
		 'columnDefs' : [
        //hide the second & fourth column
        { 'visible': false, 'targets': [6] }
    ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
        buttons: [
            { extend: "create", editor: editorsm, text:"Neuer Eintrag" },
            { extend: "edit",   editor: editorsm, text:"Eintrag bearbeiten" },
            { extend: "remove", editor: editorsm, text:"Eintrag löschen" },
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
 
        
		
		function showTable() {
			
		
			
	
	if (window.innerWidth < 800)
		{
        
			
				document.getElementById("myModalsm").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModalsm")) {
         document.getElementById("myModalsm").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("spansm").onclick = function() {
       document.getElementById("myModalsm").style.display = "none";
	
    }
		
		}
			else{
				
				document.getElementById("myModal").style.display = "block"; 
		
   // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == document.getElementById("myModal")) {
         document.getElementById("myModal").style.display = "none";
			
        }
    }
	
	 //When the user clicks on <span> (x), close the modal
     document.getElementById("span").onclick = function() {
       document.getElementById("myModal").style.display = "none";
	
    }
		
				
			}

			refreshTableTK();
			
		}
 

		function uploadTK(){


            
		 var fd = new FormData();
        var text = tinymce.get('lernproduktTextkorr').getContent();
	  var komment =tinymce.get('komment').getContent();
	  var ID = document.getElementById("ID").value;
	 var bew = document.getElementById("bew").value;
	   var beschrTK = document.getElementById("beschrTK").value;
	  
	  
	  
        fd.append('lpText',text);
	   fd.append('komment',komment);
	  fd.append('ID',ID);
	  fd.append('bew',bew);
	   fd.append('beschr',beschrTK);


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
	  
	 myVarTK = setTimeout(refreshTableTKm, 2000);
			 document.getElementById("myModalT").style.display = "none";
			
			
			
  }
     function refreshTableTK(){
		  if ( tablesm ) {
		tablesm.destroy();
	}
	
	if ( editorsm ) {
		editorsm.destroy();
	}
		
		
  
		 if ( table2 ) {
		table2.destroy();
	}
	
	if ( editor ) {
		editor.destroy();
	}
		
		
			
				  tableloadK();
		
					  tableloadKsm();
		
   		
		 
  }
		
		function refreshTableTKm(){
		  if ( tablesm ) {
		tablesm.destroy();
	}
	
	if ( editorsm ) {
		editorsm.destroy();
	}
		
		
  
		 if ( table2 ) {
		table2.destroy();
	}
	
	if ( editor ) {
		editor.destroy();
	}
		
			var searchVal=table2.search(this.value);
			var searchValsm=tablesm.search(this.value);
				  tableloadK();
			
			
					  tableloadKsm();
			table2.search(searchVal).draw();
			tablesm.search(searchValsm).draw();
				
			
			alert('Aktion ausgeführt. Bitte überprüfen Sie den Upload in der Tabelle!');
  }
		
	</script>
	
	<?
	global $current_user;

get_currentuserinfo();
	
	//echo $current_user->ID;
	?>
	
	 <input type="hidden" name="ID" id="ID">		
			
			

<button id="showTable" onClick="showTable()">Korrekturfenster anzeigen</button>	

	
	<div id="myModal" class="modal" >

    <!-- Modal content -->
    <div class="modal-content">
		<span class="close"  id="span">&times;</span>
<br><br>



<br><br>

<h1>Lernprodukte</h1>
<div class="container" >
  <div class="row">
    <form class="col-md4"></form>
  </div>
  <div class="row">
    <div class="col md12">
      <table class="table table-striped table-hover datatables"  >
        <thead>
          <tr>
           
            <th class="small-col" >ID</th>
			  <th class="big-col">Beschreibung</th>
            <th class="big-col">TEXT</th>
			<th class="norm-col">Datum</th>
	        <th class="norm-col">URL</th>
			 <th class="norm-col">Kommentar</th>
			<th class="norm-col">Korrektur</th>
		    <th  class="norm-col">Lernender</th>
			  <th  class="small-col">Bewertung</th>
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

		<div id="myModalsm" class="modal" >

    <!-- Modal content -->
    <div class="modal-content">
		<span class="close"  id="spansm">&times;</span>
<br><br>



<br><br>

<h1>Lernprodukte</h1>
<div class="container" >
  <div class="row">
    <form class="col-md4"></form>
  </div>
  <div class="row">
    <div class="col md12">
      <table class="table table-striped table-hover datatablessm">
        <thead>
          <tr>
           
             
			  <th class="norm-colsm">Beschreibung</th>
            <th class="big-colsm">TEXT</th>
	        <th class="norm-colsm">URL</th>
			<th class="norm-colsm">Korrektur</th>
			  <th class="norm-colsm">Lernender</th>
			   <th class="norm-colsm">Bew.</th>
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

	<div id="myModalT" class="modal" >

    <!-- Modal content -->
    <div class="modal-content">
		<span class="close"  id="spanT">&times;</span>
		<h3>Hier können Sie Ihre Lernprodukte hochladen</h3>
		<form action="" method="post" enctype="multipart/form-data">
Beschreibung*:<br>
		<input name="beschrTK" id="beschrTK" type=text width=200px  required="required">
		<br><br>
		
		
		
    Hier der Text des Schülers:<br><br>
	
			
   <textarea id="lernproduktTextkorr"  height="400px"  ></textarea><br><br>
			Kommentar:<br>
			<textarea id="komment"  height="100px"  ></textarea><br>
			<br><br>
			Bewertung:<br>
			<input id="bew"><br><br>
     <input type="button" value="Text hochladen" name="submit10" onClick="uploadTK()">
</form>
<br><br>





		
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

	.big-col {
  width: 20% !important;
}
	.norm-col {
  width: 10% !important;
}

	
	.big-colsm {
  width: 10% !important;
}
	.norm-colsm {
  width: 8% !important;
}

		.small-col {
  width: 5% !important;
}
	.twidth {
  width: 80% !important;
}
table.datatables{
  table-layout:fixed;
	
}
	
	table.datatablessm{
  table-layout:fixed;
	
}

.modal{
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
       
		
		.modal-content {
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