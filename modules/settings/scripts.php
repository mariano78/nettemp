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
            window.onload = function() {
                window.editor = CodeMirror.fromTextArea(code, {
                    mode: "application/x-httpd-php",
                    lineNumbers: true,
                    lineWrapping: true
                    
                });
            };
        </script>