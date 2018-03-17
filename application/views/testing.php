<form action="<?php echo base_url('cloud/testpost'); ?>"  method="post" enctype="multipart/form-data">
    <input type="file" name="files[]" id="FileUpload" onchange="selectFolder(event)"  multiple="" directory="" webkitdirectory="" mozdirectory="">
	<input type="text" id="demo" value="">

<p id="demo1" name="vbxcv" value=""></p>
	<input type="submit" value="send">
</form>
<script>
function selectFolder(e) {
    var txt = "";
    var theFiles = e.target.files;
    var relativePath = theFiles[0].webkitdirectory;
    var relativePath = theFiles[0].webkitRelativePath;
    var x = document.getElementById("FileUpload").value;
   // document.getElementById("demo").innerHTML = x;
    document.getElementById("demo1").innerHTML = theFiles[0].webkitRelativePath;
    document.getElementById("demo").innerHTML = theFiles[0].webkitRelativePath;
    var folder = relativePath.split("/");
	//$('#demo').val(folder[0]);
	$('#demo').append("this text was appended");
}
</script>