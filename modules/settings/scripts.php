<div class="panel panel-default">
<div class="panel-heading"><h3 class="panel-title">Scripts</h3></div>
<div class="panel-body">
<div class="grid">

    <textarea id="code" name="code"></textarea>

    <input type="file" onchange="loadfile(this)">
    <a href="#my-header" onclick='saveTextAsFile()'>Save/Download</a>


<?php
$root=$_SERVER["DOCUMENT_ROOT"];
$dir = "$root/tmp/";

// Sort in ascending order - this is default
$a = scandir($dir);
print_r($a);

foreach ($a as $rfile){
	
	echo $rfile;
	?> <input type="button"  id = "show" value = " <?php echo "$root/tmp/"."$rfile"; ?> ">
<?php
}

?>
<script type="text/javascript">
$(document).ready(function() {
    $("#show").click(function() {
        $.ajax({
            url : "/var/www/nettemp/tmp/zawor.php",
            dataType: "text",
            success : function (data) {
                $(".code").html(data);
				editor.setValue(data);
            }
        });
    });
}); 
</script>




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


</div>
</div>
</div>