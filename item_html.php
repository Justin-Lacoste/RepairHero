<!DOCTYPE html>
	<html>
		<head>
			<title>Page Title</title>
			<link rel="stylesheet" href="item.css">
		</head>

	<body data-gr-c-s-loaded="true">
			<button onclick="back()">Back</button>
			<img src="trash_icon.jpg" id="trash_icon" width="50px" height="50px" onclick="removeItem()" align="right">
			<img src="checkmark_icon.jpg" id="checkmark_icon" width="50px" height="50px" onclick="solveItem()" align="right">
<br>
<br>
<br>
<div class="header">
  <h1>Your Item</h1>
  <p>Check the status of your post.</p>
</div>

<div class="row">
  <div class="column">
    <h1 id="title"></h1>
			<div id="imageDiv">
				<img id="picture" width="300" height="200">
			</div>

  </div>
  
  <div class="column">
    <h2 id="price"></h2>
    <p id="text">
    	
    </p>
    <button onclick="toMessaging()" id="repairButton">I can repair it!</button>
   </div>
  </div>

<div class="footer">
  <div id="repairers"><p>Offers:<br><ul class="ArticleDiv"></ul></p></div>
</div>
		<script type="text/javascript" src="item.js"></script>
		</body>
	</html>



<!--

<!DOCTYPE html>
	<html>
		<head>
			<title>Page Title</title>
			<link rel="stylesheet" href="item.css">
		</head>
		<body>
			<button onclick="back()">Back</button>
			<img src="trash_icon.jpg" id="trash_icon" width="50px" height="50px" onclick="removeItem()">
			<img src="checkmark_icon.jpg" id="checkmark_icon" width="50px" height="50px" onclick="solveItem()">

			<h1 id="title"></h1>
			<div id="imageDiv">
				<img id="picture">
			</div>
			<h4 id="username" onclick="toProfile()"></h4>
			<h4 id="date"></h4>
			
			<h5 id="views">Views</h5>
			<h5 id="num_likes">No likes</h5>
			
			<h2 id="price"></h2>
			<br>
			<p id="text"></p>

			<button onclick="toMessaging()" id="repairButton">I can repair it!</button>

			
			<h3>Comments</h3>
 			<input type="text" id="comment" value="write your comment here">
 			
 			<button onclick="postComment()">Post comment</button>
 			<div id="comments">
 			</div>
	 		
	 		<div id="repairers">
	 			<h3>Offers:</h3>
	 			
	 		</div>

		<script type="text/javascript" src="item.js"></script>
		</body>
	</html>
