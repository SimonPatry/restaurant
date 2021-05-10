
function showBookingTable(){
    fetch('index.php?ajax=booking')
    //analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.getElementById("gestion").innerHTML = response;
	});
}





document.addEventListener("DOMContentLoaded",function(){
	document.getElementById('gestionBooking').addEventListener('click',showBookingTable);
	
})