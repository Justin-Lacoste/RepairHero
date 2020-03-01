function register() {

	//if (password == repassword) {
	email = document.getElementById("email").value;
	username = document.getElementById("username").value;
	password = document.getElementById("password").value;


		const url = 'http://localhost/repair/register.php?email=' + email + '&password=' + password + '&username=' + username;


		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		    	
		       response = JSON.parse(xhttp.responseText);
		       email = response.email;
		       username = response.username;
		       id = response.id;

		       if (response.status == "200") {	       	  
				  localStorage.setItem("email", email);
				  localStorage.setItem("id", id);
				  localStorage.setItem("username", username);


				  window.location.href = "http://localhost/repair/home.html";
		  	   }

		  		else if (response.status == "400") {
		  	  		document.getElementById("test").innerHTML = "Missing information"

		 		 }

		 		 else if (response.status == "401") {
		 		 	document.getElementById("test").innerHTML = "This email is already taken"
		 		 }
		    }
		};
		xhttp.open("REQUEST", url, true);
		xhttp.send("authorized");
	/*}
	else {

		document.getElementById("test").innerHTML = "Passwords do not match"

	}
	*/
}