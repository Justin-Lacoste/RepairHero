picture = 0

function isPicture() {

	picture += 1

}

var form = document.querySelector('form');
var request = new XMLHttpRequest();

request.upload.addEventListener('load', function(e){
	console.log('loaded and completed');

}, false);



form.addEventListener('submit', function(e){
	e.preventDefault();

	user_id = localStorage.getItem("id");
	new_text = document.getElementById("description").value;
	text = new_text.replace(/\n/g, "%newline%")
	item = document.getElementById("item").value
	username = localStorage.getItem("username");
	price = document.getElementById("price").value;

	const url = 'http://localhost/repair/write.php?user_id=' + user_id + '&username=' + username + '&price=' + price + "&item=" + item +"&action=insertRepair";

	console.log(url)

	var formData = new FormData(form);


	request.open('post', url, true);
	request.send(text)
	console.log("1")



	request.onreadystatechange = function() {
		console.log("3")
		
	   
	    	
	       response = JSON.parse(request.responseText);

	       if (response.status == "200") {
	       			console.log("hi")

	       			id = response.id

	       			var request_pic = new XMLHttpRequest();

			       	const url_pic = 'http://localhost/repair/write.php?user_id=' + user_id + '&id=' + id + '&action=insertPic';


					var formData = new FormData(form);
					request_pic.open('post', url_pic, true);
					request_pic.send(formData)


					request_pic.onreadystatechange = function() {

						if (this.readyState == 4 && this.status == 200) {

							response_pic = JSON.parse(request_pic.responseText);

							if (response_pic.status == "200") {

								window.location.href = "http://localhost/repair/profile.html"

							}

							else {
								alert("Uploaded article, but could not upload picture")
							}	
						}

				}


	  	   }
	  		else {

	  	  		alert('Something is missing')

	 	
	 		 }
	    
	};


},false);

function back() {
	window.location.href = "http://localhost/repair/profile.html"
}