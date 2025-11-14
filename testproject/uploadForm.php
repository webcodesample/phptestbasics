<?php
require_once 'common_include.php';
include_once 'head.php';
?>
<h4 class="text-center text-success mt-5 mb-3">Upload Documents</h4>
<div class="container border border-danger p-5 rounded-3 my-2" style="width:100%; max-width:400px;">
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="docs[]" class="form-control m-1 w-auto" multiple accept="Image/*, .pdf, .doc, .docx, .xls, .xlsx" required>
		<button class="btn btn-success m-1">Upload</button>
	</form>
</div>

<?php
include_once 'foot.php';
?>