function send(){

	const Http = new XMLHttpRequest();

	email = document.getElementById("email").value
	password = document.getElementById("password").value

	const url='http://localhost/repair/signin.php?email=' + email + '&password=' + password;
	Http.open("REQUEST", url);
	Http.send("authorized");

	Http.onreadystatechange = (e) => {

	  stuff = JSON.parse(Http.responseText);
	  if (stuff.status == "200") {

		  localStorage.setItem("email", stuff.email);
		  localStorage.setItem("id", stuff.id);
		  localStorage.setItem("username", stuff.username)

		  window.location.href = "http://localhost/repair/home.html"

	  }
	  else {
	  	  document.getElementById("error").innerHTML = "Wrong email or password"

	  }

	}
}
