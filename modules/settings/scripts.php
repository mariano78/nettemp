<!-- Create a simple CodeMirror instance -->

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
                    mode: "javascript",
                    lineNumbers: true,
                    lineWrapping: true,
                    foldGutter: {
                        rangeFinder: new CodeMirror.fold.combine(CodeMirror.fold.brace, CodeMirror.fold.comment)
                    },
                    gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"]
                });
            };
        </script>


</div>
</div>
</div>

