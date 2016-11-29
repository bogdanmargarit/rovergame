<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>MarsRover</title>
		<script src="js/jquery-3.1.1.min.js"></script>
		<style>
			body {
				font-family: Courier New;
				font-size: 22px;
			}
		</style>
	</head>
	<body>
		<output id="game-output">Press any arrow key to start.</output>
	</body>
	<script>
		// Key codes for the arrows.
		var NORTH = 38;
		var SOUTH = 40;
		var EAST = 39;
		var WEST = 37;
		
		var action = '';

		$(function() {
			$(document).on('keydown', function(e) {
				switch (e.keyCode) {
					case NORTH:
						action = 'http://127.0.0.1/Rover1/game.php?action=move&direction=north';
						break;
					case SOUTH:
						action = 'http://127.0.0.1/Rover1/game.php?action=move&direction=south';
						break;
					case EAST:
						action = 'http://127.0.0.1/Rover1/game.php?action=move&direction=east';
						break;
					case WEST:
						action = 'http://127.0.0.1/Rover1/game.php?action=move&direction=west';
						break;
				}
				$.ajax({
					type: 'GET',
					url: action
				}).done(function(response) {
					$('#game-output').html(response + '<a href="restart.php">Restart</a>');
				}).fail(function(response) {
					console.log(response);
				});
			});
		});
	</script>
</html>