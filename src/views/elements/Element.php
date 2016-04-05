<?php

namespace dark_horse\hw3\views\elements;

?>

<html>
<body>

<form action = "../../controllers/Controller.php" method = "post" enctype = "multipart/form-data">
	Upload a photo! <input type = "file" name = "photo" size = "25" />
	Add a caption! <input type = "text" name = "caption" maxlength="50"/>
	<input type = "submit" name = "submit" value = "Submit" />
</form>

</body>
</html>
