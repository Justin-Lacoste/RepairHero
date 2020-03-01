const urlParams = new URLSearchParams(window.location.search)
const a = urlParams.get('a')

item_id_for_later = 0

var id = localStorage.getItem("item_id");


if (a != null) {
	
	id = a
}



const Http = new XMLHttpRequest();

const url='http://localhost/repair/item.php?item_id=' + id + '&action=loadItem';
Http.open("REQUEST", url);
Http.send("authorized");

Http.onreadystatechange = (e) => {

	if (Http.readyState == 4 && Http.status == 200){
		if (Http.responseText){

	stuff = JSON.parse(Http.responseText);

	text = stuff.post[0].text;

	new_text = text.replace(/%newline%/g, '<br>')

	item = stuff.post[0].item;

	item_id_for_later = item_id_for_later + item

	username = stuff.post[0].username;

	picture = stuff.post[0].picture;

	date_created = stuff.post[0].date_created;

	user_id = stuff.post[0].user_id

	price = stuff.post[0].price


	document.getElementById("price").innerHTML = "Max price: $" + price

	localStorage.setItem("recipient_id", user_id)

	document.getElementById("text").innerHTML = new_text

	if (localStorage.getItem("id") == user_id) {
		document.getElementById("repairButton").remove()
	}
	if (localStorage.getItem("id") != user_id) {
		document.getElementById("trash_icon").remove()
		document.getElementById("checkmark_icon").remove()
		document.getElementById("repairers").remove()

	}


	if (picture != "") {
		document.getElementById("picture").src = picture;
		document.getElementById("picture").setAttribute("width", "300")
		document.getElementById("picture").setAttribute("height", "200")

	}
	if (picture == "" || picture == null || picture == undefined) {
		document.getElementById("picture").remove()
	}
	if (localStorage.getItem("id") == user_id) {


	const Httpss = new XMLHttpRequest();

		const url_gog='http://localhost/repair/item.php?item_id=' + localStorage.getItem("item_id") + '&action=loadOffers';
		Httpss.open("REQUEST", url_gog);
		Httpss.send("authorized");

		Httpss.onreadystatechange = (e) => {
			if (Httpss.readyState == 4 && Httpss.status == 200){
				if (Httpss.responseText){

					responsed = JSON.parse(Httpss.responseText)
					console.log(responsed);

					var div = document.getElementById("repairers");

					var listElement = document.createElement('ul');

					listElement.setAttribute("class", "ArticleDiv");

					div.appendChild(listElement)


					var numberOfListItems = responsed.post.length;

					for (var i = 0; i < numberOfListItems; ++i) {

						var globalItem = document.createElement('li')
						globalItem.setAttribute("id", "liTag")
						globalItem.setAttribute("onclick", `toConvo(${responsed.post[i].user_id})`)

					    var listItem = document.createElement('h3');
					    listItem.setAttribute("id", "h3tag");
					    listItem.innerHTML = responsed.post[i].username

					    globalItem.appendChild(listItem)

					    listElement.appendChild(globalItem)
					}

				}
			}
		}
	}


}
}
}



function back() {
	window.location.href = "http://localhost/repair/home.html"
}

function removeItem() {

	const Httpp = new XMLHttpRequest();

	const url_remove='http://localhost/repair/item.php?item_id=' + id + '&action=removeItem';
	Httpp.open("REQUEST", url_remove);
	Httpp.send("authorized");

	Httpp.onreadystatechange = (e) => {
		if (Httpp.readyState == 4 && Httpp.status == 200){
				if (Httpp.responseText){

		response = JSON.parse(Httpp.responseText);

		if (response.status == "200") {
			alert("Action successfull")
			window.location.href = "http://localhost/repair/home.html"
		}
		if (response.status == "400") {
			alert("Something went wrong. Please try again later")
		}
	}
	}
	}
}

function solveItem() {

	const Httpps = new XMLHttpRequest();

	const url_solve='http://localhost/repair/item.php?item_id=' + item_id_for_later + '&user_id=' + localStorage.getItem("id") + '&action=solveItem';
	Httpps.open("REQUEST", url_solve);
	Httpps.send("authorized");

	Httpps.onreadystatechange = (e) => {
		if (Httpps.readyState == 4 && Httpps.status == 200){
				if (Httpps.responseText){

			removeItem()
	}
	
	}

}
}

function toMessaging() {
	const Https = new XMLHttpRequest();

	const url_go='http://localhost/repair/item.php?item_id=' + id + '&user_id=' + localStorage.getItem("id") + '&action=addJob';
	Https.open("REQUEST", url_go);
	Https.send("authorized");

	Https.onreadystatechange = (e) => {
		if (Https.readyState == 4 && Https.status == 200){
			if (Https.responseText){
				
				alert(JSON.parse(Https.responseText))
				window.location.href = "http://localhost/repair/messaging_html.php?convo=" + id;

			}
		}
	}
}

function toConvo(other_person_id) {
	localStorage.setItem("recipient_id", other_person_id)
	window.location.href = "http://localhost/repair/messaging_html.php"
}