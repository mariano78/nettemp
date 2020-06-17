<!-- Create a simple CodeMirror instance -->

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Scripts</h3></div>
<div class="panel-body">
<div class="grid">

<div class="controls">
    <select id='select'>
         <option selected>shell</option>
         <option>application/x-httpd-php</option>
    </select>
</div>


<form style="width:500px;">
    <textarea id="code">

    </textarea>
</form>

	
</div>
</div>
</div>



<script>

	var editor = CodeMirror.fromTextArea($("#code")[0], { //script_once_code is the ID number of your textarea
			lineNumbers: true,/ / Whether to display the line number
			matchBrackets: true,
			mode:"shell",　//Default script encoding
			lineWrapping:true, / / Is it mandatory to wrap?
			indentUnit: 8,
			indentWithTabs: true,
			enterMode: "keep",
			tabMode: "shift"
 });
	
</script>
<script>	  
	  
	  / / Select interface style JS
$('#select').change(function(){
     var emode = $('#select').val();
         editor.setOption("mode", emode); //editor.setOption() is a method for setting styles provided by codeMirror
		 editor.setValue('dasdadsadsad');
 }); 

</script>
	
