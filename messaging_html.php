<!DOCTYPE html>
	<html>
		<head>
			<title>Chat Room</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<style>
				*{box-sizing; border-box;}
				h2 {
					border: 2px solid orange;
  					padding: 10px 20px;
				}
				.open-button {
 					background-color: orange;
 					color: white;
 					padding: 16px 20px;
 					position: fixed;
 					bottom: 23px;
 					right: 23px;
 					opacity: 0.8;
				}
				.chat-popup {
					display: none;
  					position: fixed;
  					bottom: 0;
  					right: 20px;
  					border: 3px solid orange;
				}
				.form-container textarea{
					width: 90%;
					padding: 15px;
					margin: 5px 0 22px 0;
					background: lightgrey;
					min-height: 200px;
				}
				.form-container textarea:focus {
					background-color: #D8D8D8;
				}
				.form-container .btn {
					background-color: green;
  					color: white;
  					padding: 16px 20px;
  					width: 100%;
  					margin-bottom:10px;
				}
				.form-container .cancel {
					background-color: orange;
				}

				.container {
				  border: 2px solid #dedede;
				  background-color: #f1f1f1;
				  border-radius: 5px;
				  padding: 10px;
				  margin: 10px 0;
				}

				#containerMe {
				  border-color: #ccc;
				}

				#containerYou {
				  border-color: #ccc;
				  background-color: #ddd;
				}

				.container::after {
				  content: "";
				  clear: both;
				  display: table;
				}
			</style>
		</head>
		<body>
			<button id="backButton" onclick="back()">Back</button>
			
			<h2>Welcome to the chat</h2>

			<div id="messages">
				
			</div>

			<button class="open-button" onclick="openForm()">Chat</button>
			<div class="chat-popup" id="myForm">
  				<form class="form-container">
					<label for="msg"><b>Message</b></label>
    				<textarea id="textarea" placeholder="Type message.." name="msg" required></textarea>
					<button type="submit" onclick="sendMessage()" class="btn">Send</button>
   					<button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  				</form>
			</div>
			<script>
				function openForm() {
  					document.getElementById("myForm").style.display = "block";
				}
				function closeForm() {
  					document.getElementById("myForm").style.display = "none";
  				}
  			</script>
  			<script type="text/javascript" src="messaging.js">s</script>

    	</body>			
	</html>
