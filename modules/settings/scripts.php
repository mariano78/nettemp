
<script src='http://codemirror.net/lib/codemirror.js'></script>
<script src='http://codemirror.net/mode/xml/xml.js'></script>
<script src='http://codemirror.net/mode/javascript/javascript.js'></script>
<script src='http://codemirror.net/mode/css/css.js'></script>
<script src='http://codemirror.net/mode/htmlmixed/htmlmixed.js'></script>
<link rel='stylesheet' href='http://codemirror.net/lib/codemirror.css'>
<link rel='stylesheet' href='http://codemirror.net/doc/docs.css'>


    <textarea id="code" name="code"></textarea>

  

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