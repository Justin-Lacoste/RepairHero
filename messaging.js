id=localStorage.getItem("id")
recipient_id=localStorage.getItem("recipient_id")

console.log(id)

const Http = new XMLHttpRequest();

const url='http://localhost/repair/messaging.php?user_id=' + id + '&recipient_id=' + recipient_id + '&action=getMessages';
Http.open("POST", url);
Http.send();

Http.onreadystatechange = function(){

	if (Http.readyState == 4 && Http.status == 200){
		if (Http.responseText){
			response = JSON.parse(Http.responseText)

			length = response[0].length;

			for (var i = 0; i < length; ++i) {


				globalContainer = document.getElementById("messages")

				if (response[0][i].user_id == id) {

					var messageContainerMe = document.createElement('div');
					messageContainerMe.setAttribute("id", "containerMe")
					messageContainerMe.setAttribute("class", "container")

					var messageMe = document.createElement("h3")

					messageMe.innerHTML = response[0][i].message

					messageContainerMe.appendChild(messageMe)

					globalContainer.appendChild(messageContainerMe)
				}
				else {

					var messageContainerYou = document.createElement('div');
					messageContainerYou.setAttribute("id", "containerYou")
					messageContainerYou.setAttribute("class", "container")


					var messageYou = document.createElement("h3")
					messageYou.innerHTML = response[0][i].message


					messageContainerYou.appendChild(messageYou)

					globalContainer.appendChild(messageContainerYou)
				}
			}

		}
	}
}









function sendMessage() {
	message = document.getElementById("textarea").value

	const Https = new XMLHttpRequest();

	const url_send='http://localhost/repair/messaging.php?user_id=' + id + '&recipient_id=' + recipient_id + '&message=' + message +'&action=sendMessage';
	Https.open("POST", url_send);
	Https.send();

	Https.onreadystatechange = function(){

		if (Https.readyState == 4 && Https.status == 200){
			if (Https.responseText){

				response_message = JSON.parse(Https.responseText)

				document.getElementById("textarea").value = "";


			}
		}
	}
}

function back() {
	window.location.href = "http://localhost/repair/jobs.html"
}