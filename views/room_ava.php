<!DOCTYPE html>
<html>
<head>
	<title>Training Room Availability</title>
	<link rel="stylesheet" type="text/css" href="./Style/style.css">
</head>
<body>
	<nav>
		<h1>Expert Training Management Portal</h1>
		<ul>
			<li><a href="#">HOME</a></li>
			<li><a href="#">ENQEUIRIES</a></li>
			<li><a href="#">SUPPORT</a></li>
			<li><a href="#">Icon</a></li>
		</ul>
	</nav>
	<main>
		<div class="left-sidebar">
			<div class="left-sidebarbutton">
				<a href="#">Programs</a>
			</div>

			<div class="left-sidebarbutton">
				<a href="#">Requests</a>
			</div>

			<div class="left-sidebarbutton">
				<a href="#">Rooms</a>
			</div>
		</div>

		<h1>Training Room Availability</h1>
		<p>Please select a date and time:</p>
		<form>
			<table>
				<tr> 
					<th><label for="date">Date:</label></th>
					<td><input type="date" id="date" name="date"></td>
				</tr>

				<tr>
					<th><label for="time">Time:</label></th>
					<td><input type="time" id="time" name="time"></td>
				</tr>
			</table>
			
			
			
			
			<button type="submit">Check Availability</button>
		</form>
		<p>Available Rooms:</p>
		<div>
			<li>Room 1</li>
			<li>Room 2</li>
			<li>Room 3</li>
			<li>Room 4</li>
		</div>
	</main>
</body>
</html>
