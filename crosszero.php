<html>
	<head>
		<title>Cross Zero</title>
		<script src="scripts/crosszero.js"></script>
	</head>
	<body>
		<h1>Play Cross Zero</h1>
		<form name="czero">
			<input hidden class ="cell" type="button" value="" name="1" onClick="move(1)"><input hidden class ="cell" type="button" value="" name="2" onClick="move(2)"><input hidden class ="cell" type="button" value="" name="3" onClick="move(3)"><br>
			<input hidden class ="cell" type="button" value="" name="4" onClick="move(4)"><input hidden class ="cell" type="button" value="" name="5" onClick="move(5)"><input hidden class ="cell" type="button" value="" name="6" onClick="move(6)"><br>
			<input hidden class ="cell" type="button" value="" name="7" onClick="move(7)"><input hidden class ="cell" type="button" value="" name="8" onClick="move(8)"><input hidden class ="cell" type="button" value="" name="9" onClick="move(9)"><br><br>
			<input type="button" value="2 Player" name="single" onClick="start_game(0)">&nbsp;<input type="button" value="CPU" name="cpu" onClick="start_game(1)">
		</form>
	</body>
</html>