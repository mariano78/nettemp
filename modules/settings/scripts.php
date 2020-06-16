<!-- Create a simple CodeMirror instance -->
<script src="../common/codemirror/php/php.js"></script>
<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Scripts</h3></div>
<div class="panel-body">
<div class="grid">


<form style="width:500px;">
            <textarea id="code" name="code">
alert("HI");
//says HII
            </textarea>
        </form>
		
		
		
	
	<script>
            window.onload = function() {
                window.editor = CodeMirror.fromTextArea(code, {
                    mode: "php",
                    lineNumbers: true,
                    lineWrapping: true
                    
                });
            };
        </script>


</div>
</div>
</div>

