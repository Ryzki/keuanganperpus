<?php
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=export.xls");
// Fix for crappy IE bug in download.
header("Pragma: ");
header("Cache-Control: ");
?>
<html>
<head></head>
<body><?php echo $_REQUEST['datatodisplay'];?>
</body>
</html>
