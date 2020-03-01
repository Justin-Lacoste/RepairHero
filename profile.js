document.getElementById("username").innerHTML = localStorage.getItem("username")
id = localStorage.getItem("id")

listOfItems = ["nothing", "Computer", "Phone", "Bike", "Furniture", "Clothes", "Car"]

const Https = new XMLHttpRequest();

const url='http://localhost/repair/profile.php?id=' + id + '&action=myItems';
Https.open("POST", url);
Https.send();


Https.onreadystatechange = function(){

	if (Https.readyState == 4 && Https.status == 200){
		if (Https.responseText){

				stuff = JSON.parse(Https.responseText);
				console.log(stuff)

				if (stuff.message == "Cound not find posts") {

					document.getElementById("listOfItems").innerHTML = "No items yet";

           		}

					var listContainer = document.createElement('div');
					listContainer.setAttribute("id", "sub_article")


					/////a' ici

					    // Add it to the page
					document.getElementById('listOfItems').appendChild(listContainer);

					    // Make the list
					var listElement = document.createElement('ul');

					listElement.setAttribute("class", "ArticleDiv");

					    // Add it to the page
					listContainer.appendChild(listElement);


					var numberOfListItems = stuff[0].length;


					//post_loaded += numberOfListItems

					for (var i = 0; i < numberOfListItems; ++i) {
					        // create an item for each one

					    var globalItem = document.createElement('li')

					    var listItem = document.createElement('h3');
					     // Add the item text

					    listItem.setAttribute("id", 'itemElementLI');


					    globalItem.setAttribute("id", `${stuff[0][i].id}`)

					    globalItem.setAttribute("class", "individualItem")
					    globalItem.setAttribute("onclick", `toItem(this.id)`)

					    sub_div_one = document.createElement("div")
					    sub_div_one.setAttribute("id", "sub_div_one")

					    var listPrice = document.createElement('h3')
					    listPrice.innerHTML = stuff[0][i].price + "$"

					    listItem.innerHTML = listOfItems[stuff[0][i].item];
					    sub_div_one.appendChild(listItem)
					    sub_div_one.appendChild(listPrice)


					    if (stuff[0][i].picture != "") {

					    	sub_div = document.createElement("div")
					    	sub_div.setAttribute("id", "sub_div")

					    	picture = stuff[0][i].picture
							secondListItem = document.createElement('img')
							secondListItem.src = stuff[0][i].picture;
							/*
							secondListItem.setAttribute("width", "325")
							*/

							secondListItem.setAttribute("width", "100%")
							secondListItem.setAttribute("height", "100%")
		
							secondListItem.setAttribute("id", "pictureElementLi")

							sub_div.appendChild(secondListItem)
							globalItem.appendChild(sub_div)
						}

						globalItem.appendChild(sub_div_one);
						    // Add listItem to the listElement
					    listElement.appendChild(globalItem)

					}

		}
	}
}







function toWrite() {
	window.location.href = "http://localhost/repair/write.html"
}




function appearModemToAddRepair() {

    setTimeout(function () {

	// Get the modal
	var modal = document.getElementById("myModal");

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	  modal.style.display = "block";

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	}
        
    }, 500);
}


function submitNewKnowledge() {
	var computer = document.getElementById("computer").checked
	var phone = document.getElementById("phone").checked
	var bike = document.getElementById("bike").checked
	var furniture = document.getElementById("furniture").checked
	var clothes = document.getElementById("clothes").checked
	var car = document.getElementById("car").checked

	toCheck = [computer, phone, bike, furniture, clothes, car]

	console.log(toCheck)

	for (i = 0; i < 6; i++) {

		if (toCheck[i] == true) {

			const Http = new XMLHttpRequest();

			const url='http://localhost/repair/profile.php?id=' + id + '&item=' + (i+1) + '&action=adRepairKnowledge';
			Http.open("REQUEST", url);
			Http.send("authorized");

			Http.onreadystatechange = (e) => {
				if (Http.readyState == 4 && Https.status == 200){
					if (Http.responseText){
			  stuff = JSON.parse(Http.responseText);

			  if (stuff.status == "200") {

			  	console.log("all good for item" + 1)

			  }
			  else {
			  	  console.log("there's an error somewhere")
			  }
			
			}
				}
			}
		}
		else {

			console.log(i + "is skipped")
		}

	}

}

function toItem(id_item) {
	localStorage.setItem("item_id", id_item)
	window.location.href = "http://localhost/repair/item_html.php?id=" + id_item;
}

function logout() {
	localStorage.setItem("id", "")
	window.location.href = "http://localhost/repair/signin.html";
}



carbon_array = [0, 318, 154, 118, 60, 15, 6000]


const Httpss = new XMLHttpRequest();

const url_carbon='http://localhost/repair/profile.php?id=' + id  +'&action=carbonCounter';
Httpss.open("POST", url_carbon);
Httpss.send();

Httpss.onreadystatechange = function(){

	if (Httpss.readyState == 4 && Httpss.status == 200){
		if (Httpss.responseText){

			response_message = JSON.parse(Httpss.responseText)

			console.log(response_message)

			length = response_message[0].length

			total = 0

			for (i = 0; i < length; i++) {
				total = total + carbon_array[response_message[0][i].item]
			}

			document.getElementById("carbonNumber").innerHTML = "You saved " + total + " kg of carbon by repairing instead of buying!";
		}
	}
}