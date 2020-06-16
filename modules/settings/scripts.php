<textarea id="java-code"></textarea>
<script>

 var javaEditor = CodeMirror.fromTextArea(document.getElementById("java-code"), {
    lineNumbers: true,
    matchBrackets: true,
    mode: "text/x-java"
  });
  var mac = CodeMirror.keyMap.default == CodeMirror.keyMap.macDefault;
  CodeMirror.keyMap.default[(mac ? "Cmd" : "Ctrl") + "-Space"] = "autocomplete";
  
 </script>