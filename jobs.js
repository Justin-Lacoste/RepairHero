listOfItems = ["nothing", "Computer", "Phone", "Bike", "Furniture", "Clothes", "Car"]

limit = 10;
offset = 0;
id = localStorage.getItem("id")

const Https = new XMLHttpRequest();

const url='http://localhost/repair/jobs.php?id=' + id + '&action=loadJobs';
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

					console.log(numberOfListItems)

					

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

						else {

						}

						globalItem.appendChild(sub_div_one);
						    // Add listItem to the listElement
					    listElement.appendChild(globalItem)

					}
		}
	}
}

function toItem(id_item) {
	localStorage.setItem("item_id", id_item)

	const Httpps = new XMLHttpRequest();

	const url_go='http://localhost/repair/jobs.php?id=' + id_item + '&user_id=' + localStorage.getItem("id") + '&action=straightToChat';
	Httpps.open("post", url_go);
	Httpps.send("authorized");

	Httpps.onreadystatechange = (e) => {
		if (Httpps.readyState == 4 && Httpps.status == 200){
			if (Httpps.responseText){

				responsee = JSON.parse(Httpps.responseText)

				console.log(responsee.post[0].recipient_id)

				localStorage.setItem("recipient_id", responsee.post[0].recipient_id)
				
				window.location.href = "http://localhost/repair/messaging_html.php?convo=" + id;

			}
		}
	}

}


function logout() {
	localStorage.setItem("id", "")
	window.location.href = "http://localhost/repair/signin.html";
}