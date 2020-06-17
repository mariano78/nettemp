<!-- Create a simple CodeMirror instance -->

<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Scripts</h3></div>
<div class="panel-body">
<div class="grid">


<form style="width:500px;">
    <textarea id="code" name="code">

    </textarea>
</form>

<div>
    <input type="file" onchange="localLoad(this.files);" />
</div>
	
</div>
</div>
</div>

	<script>

   function localLoad(files) {
       if (files.length == 1) {
            document.title = escape(files[0].name);
            var reader = new FileReader();
            reader.onload = function(e) {
              myCodeMirror.setValue(e.target.result);
            };
            reader.readAsText(files[0]);
         }
    }
</script>

<script>
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 8,
        indentWithTabs: true,
        enterMode: "keep",
        tabMode: "shift"
      });
    </script>
	
