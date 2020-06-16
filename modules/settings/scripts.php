<!-- Create a simple CodeMirror instance -->
<script src="../../common/codemirror/php/php.js"></script>
<script src="../../common/codemirror/clike/clike.js"></script>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Scripts</h3></div>
<div class="panel-body">
<div class="grid">


<form style="width:500px;">
    <textarea id="code" name="code">

    </textarea>
</form>
	
</div>
</div>
</div>

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