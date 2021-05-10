

function showBookingTable(event){
    event.preventDefault();
    fetch('index.php?ajax=booking')
    //analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.getElementById("gestion").innerHTML = response;
		document.querySelectorAll('.editBooking').forEach(booking => {booking.addEventListener('click', editBooking)});
		document.querySelectorAll('.deleteBooking').forEach(booking => {booking.addEventListener('click', deleteBooking)});
	});
}

function editBooking(event){
	event.preventDefault();
	if (this.parentNode.parentNode.parentNode.className == "input"){
		this.parentNode.parentNode.parentNode.classList.toggle("hide");
		this.parentNode.parentNode.parentNode.previousSibling.previousSibling.classList.toggle("hide");
		
		let id = this.parentNode.parentNode.parentNode.dataset.id;
		let updateBooking = {
			number: document.querySelector(`#id${id} .number`).value,
			date: document.querySelector(`#id${id} .date`).value,
			hour: document.querySelector(`#id${id} .hour`).value,
			status: document.querySelector(`#id${id} .status`).value,
			comment: document.querySelector(`#id${id} .comment`).value,
			id : id
		};
		
		updateBooking = JSON.stringify(updateBooking);
		
		let options = {
		method : 'POST',
		body : updateBooking,
		headers:{'Content-Type':'application/json'}
		};
		
		fetch(`index.php?ajax=editBooking`, options)
		.then(function(){
			showBookingTable(event);
		});
	}
	else {
		this.parentNode.parentNode.parentNode.classList.toggle("hide");
		this.parentNode.parentNode.parentNode.nextSibling.nextSibling.classList.toggle("hide");
	}
}

function deleteBooking(event){
	event.preventDefault();
	let id = this.dataset.id;
	console.log(id);
	fetch(`index.php?ajax=deleteBooking&id=${id}`)
    .then(function(){
		showBookingTable(event);
	});
}


// fonction pour afficher les inputs avec une requete ajax
// function editBooking(){
// 	console.log("test");
//     event.preventDefault();
//     let id = this.dataset.id;
//     fetch(`index.php?ajax=booking&idModif=${id}`)
//     //analyser la réponse
// 	.then(response => response.text())
// 	//utilise la réponse
// 	.then(response => {
// 		document.getElementById("gestion").innerHTML = response;
// 	});
// }





document.addEventListener("DOMContentLoaded",function(){
	document.getElementById('gestionBooking').addEventListener('click',showBookingTable);
	
})