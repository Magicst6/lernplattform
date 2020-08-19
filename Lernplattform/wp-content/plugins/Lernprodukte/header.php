<html>


	
	<head>


	
<!--	<link rel="stylesheet" type="text/css" href="/wp-content/themes/structr/Page_Scripts/DataTables-1.10.19/examples/resources/demo.css">-->
		<link rel="stylesheet" type="text/css" href="/Datatables/DataTables-1.10.19/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="/Datatables/DataTables-1.10.19/examples/resources/syntax/shCore.css">
	<link rel="stylesheet" type="text/css" href="/Datatables/DataTablesEditor/css/editor.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
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
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
	
<meta name="viewport" content="width=device-width, initial-scale=1">
	

	
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js"></script>


	<script src="https://cdn.tiny.cloud/1/p4y59yu91l1ttdi8h066ovomyunbzi9p44zqccnlmn9ly5ge/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
		tinymce.init({
        selector: '#lernproduktTextkorrP',
		  readonly : 0,
		  menubar: true,
		  height:600,
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
			toolbar: 'undo redo | bold italic underline strikethrough  | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
			quickbars_selection_toolbar: 'forecolor backcolor strikethrough superscript subscript removeformat wordcount',
      });
  		tinymce.init({
        selector: '#lernproduktTextkorr',
		  readonly : 0,
		  menubar: true,
		  height:600,
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
			toolbar: 'undo redo | bold italic underline strikethrough  | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
			quickbars_selection_toolbar: 'forecolor backcolor strikethrough superscript subscript removeformat wordcount',
      });
	tinymce.init({
        selector: '#komment',
		  readonly : 0,
		  menubar: false,
		  height:200,
		plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
	tinymce.init({
        selector: '#kommentP',
		  readonly : 0,
		  menubar: false,
		  height:200,
		plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
		tinymce.init({
        selector: '#lernproduktText1',
		  readonly : 0,
		  menubar: false,
		  height:600,
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
		tinymce.init({
        selector: '#lernproduktText1sm',
		  readonly : 0,
		  menubar: false,
		  height:600,
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
	tinymce.init({
        selector: '#lernproduktText',
		  readonly : 0,
		  menubar: false,
		  height:600,
		plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
		tinymce.init({
        selector: '#lernproduktTextsm',
		  readonly : 0,
		  menubar: false,
		  height:600,
			plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
		toolbar: 'wordcount | undo redo | bold italic underline strikethrough  |fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | wordcount| charmap emoticons | fullscreen  preview print  |  image media   link',
		quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable | wordcount',
      });
	  </script>
	
</head>
	
	<style>
	.beschr {
  width: 200px !important;
}
	</style>
