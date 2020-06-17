<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CodeMirror: HTML5 preview</title>
<script src='http://codemirror.net/lib/codemirror.js'></script>
<script src='http://codemirror.net/mode/xml/xml.js'></script>
<script src='http://codemirror.net/mode/javascript/javascript.js'></script>
<script src='http://codemirror.net/mode/css/css.js'></script>
<script src='http://codemirror.net/mode/htmlmixed/htmlmixed.js'></script>
<link rel='stylesheet' href='http://codemirror.net/lib/codemirror.css'>
<link rel='stylesheet' href='http://codemirror.net/doc/docs.css'>
<style type='text/css'>
.CodeMirror {
    float: left;
    width: 50%;
    border: 1px solid black;}

iframe {
    width: 49%;
    float: left;
    height: 300px;
    border: 1px solid black;
    border-left: 0px;}
</style>
</head>
<body>
    <textarea id="code" name="code"><!doctype html>
<html>
<head>
<meta charset=utf-8>
<title>HTML5 canvas demo</title>
<style>p {font-family: monospace;}</style>
</head>
<body>
    <p>Canvas pane goes here:</p>
    <canvas id=pane width=300 height=200></canvas>

    <script>
      var canvas = document.getElementById('pane');
      var context = canvas.getContext('2d');

      context.fillStyle = 'rgb(250,0,0)';
      context.fillRect(10, 10, 55, 50);

      context.fillStyle = 'rgba(0, 0, 250, 0.5)';
      context.fillRect(30, 30, 55, 50);
    </script>
</body>
</html></textarea>

    <iframe id="preview"></iframe>

    <input type="file" onchange="loadfile(this)">
    <a href="#my-header" onclick='saveTextAsFile()'>Save/Download</a>

<script>
var delay;

// Initialize CodeMirror editor
var editor = CodeMirror.fromTextArea(document.getElementById('code'), {
    mode: 'text/html',
    tabMode: 'indent',
    lineNumbers: true,
    lineWrapping: true,
    autoCloseTags: true
});

// Live preview
editor.on("change", function() {
    clearTimeout(delay);
    delay = setTimeout(updatePreview, 300);
});

function updatePreview() {
    var previewFrame = document.getElementById('preview');
    var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
    preview.open();
    preview.write(editor.getValue());
    preview.close();
}
setTimeout(updatePreview, 300);

function saveTextAsFile() {
    var textToWrite = document.getElementById("code").value;
    var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
    var fileNameToSaveAs = "myfile.html";

    var downloadLink = document.createElement("a");
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = "Download File";
    if (window.webkitURL != null)
    {
        // Chrome allows the link to be clicked
        // without actually adding it to the DOM.
        downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
    }
    else
    {
        // Firefox requires the link to be added to the DOM
        // before it can be clicked.
        downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
    }

    downloadLink.click();}

function destroyClickedElement(event) {
    document.body.removeChild(event.target);}

function loadfile(input){
    var reader = new FileReader();
    reader.onload = function(e) {
    editor.setValue(e.target.result);
}
    reader.readAsText(input.files[0]);}

    var input = document.getElementById("select");

    function selectTheme() {
      var theme = input.options[input.selectedIndex].innerHTML;
      editor.setOption("theme", theme);
    }

    var choice = document.location.search &&
               decodeURIComponent(document.location.search.slice(1));
    if (choice) {
      input.value = choice;
      editor.setOption("theme", choice);
    }
</script>
</body>
</html>