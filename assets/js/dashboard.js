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
		document.getElementById("addBooking").addEventListener('click', addBooking);
	
	});
}

function editBooking(event){
	event.preventDefault();
	if (this.parentNode.parentNode.parentNode.className == "input"){
		this.parentNode.parentNode.parentNode.classList.toggle("hide");
		this.parentNode.parentNode.parentNode.previousElementSibling.classList.toggle("hide");
		
		let id = this.parentNode.parentNode.parentNode.dataset.id;
		let user = this.dataset.user;
		let updateBooking = {
			user : user,
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
		this.parentNode.parentNode.parentNode.nextElementSibling.classList.toggle("hide");
	}
}

function deleteBooking(event){
	event.preventDefault();
	let confirm = window.confirm("Etes-vous sûr de vouloir supprimer cette réservation ?");
    if (confirm){
        let id = this.dataset.id;
		fetch(`index.php?ajax=deleteBooking&id=${id}`)
	    .then(function(){
			showBookingTable(event);
		});
    }
}

function addBooking(event){
	event.preventDefault();
	let user = this.dataset.user;
	let addBooking = {
		user : user,
		number: document.querySelector(`#add .number`).value,
		date: document.querySelector(`#add .date`).value,
		hour: document.querySelector(`#add .hour`).value,
		status: document.querySelector(`#add .status`).value,
		comment: document.querySelector(`#add .comment`).value,
	};
	console.log(addBooking);
	addBooking = JSON.stringify(addBooking);
	
	let options = {
	method : 'POST',
	body : addBooking,
	headers:{'Content-Type':'application/json'}
	};
	
	fetch('index.php?ajax=addBooking', options)
	.then(function(){
		showBookingTable(event);
	});
}

function showCategoryTable(event=null){
    if (event != null)
        event.preventDefault();
    fetch("index.php?ajax=categories")
    .then(response => response.text())
    .then(response => {
        document.getElementById("gestion").innerHTML = response;
        document.querySelectorAll(".editCat").forEach(category => {category.addEventListener("click", editCategory)});
         document.querySelectorAll(".delCat").forEach(category => {category.addEventListener("click", delCategory)});
         document.getElementById('newCat').addEventListener("click", addCategory);
    });
}

function delCategory(){
	if(window.confirm("Etes vous sur de vouloir suppriemr cette catégorie ?")){
	    event.preventDefault();
	    let tr = this.parentNode.parentNode;
	    fetch(`index.php?ajax=delCategory&id=${tr.id}`)
	    .then(response => {
	        showCategoryTable();
	    });
	}
}

function addCategory(){
    event.preventDefault();
	let  category = {
		name: document.getElementById("catName").value,
		is_dish: document.getElementById("is_dish").value,
		description: document.getElementById("description").value,
	}
	console
    category = JSON.stringify(category);
    let options = {
    	method : 'POST',
    	body : category,
    	headers:{'Content-Type':'application/json'}
    }

    fetch(`index.php?ajax=addCategory`, options)
    .then( function (){
	    showCategoryTable();
    })
}

function editCategory(){
    event.preventDefault();
    let tr = this.parentNode.parentNode;
    tr.classList.toggle("hide");
    if (tr.dataset.id == 1){
        tr.nextElementSibling.classList.toggle("hide");
        let cat = document.getElementById(tr.id);
    	let  category = {
    		id: tr.querySelector(".id").value,
    		name: tr.querySelector(".name").value,
    		is_dish: tr.querySelector(".is_dish").value,
    		description: tr.querySelector(".description").value,
    	}
        category = JSON.stringify(category);
        let options = {
        	method : 'POST',
        	body : category,
        	headers:{'Content-Type':'application/json'}
        }
        
        fetch(`index.php?ajax=editCategory`, options)
        .then( function (){
		    showCategoryTable();
	    })
    }
    else{
        tr.previousElementSibling.classList.toggle("hide");
    }
}


/********************************************************/
/*                      MENUS
/********************************************************/

// fonction pour afficher le contenu du dashbord en ajax 
function showMenusTable(event){
    event.preventDefault();
    fetch("index.php?ajax=menus")
    .then(response => response.text())
    //utilise la réponse
    .then(response => {
        //on affiche dans le phtml de dashboard id gestion
        document.getElementById("gestion").innerHTML = response;
        //sur quel bouton il clic
        let menus = document.querySelectorAll('.btn-modify')
        menus.forEach((menu)=>{
            menu.addEventListener('click',showForm);
        })
        let delMenus = document.querySelectorAll('.delete-menus')
        delMenus.forEach((deleteMenu)=>{
            deleteMenu.addEventListener('click',deleteMenus);
        })
        
        document.querySelector('.add-one-menu').addEventListener('click',showForm);
    });   
     
}

function showForm(event)
{
    event.preventDefault();
    let id = this.dataset.id;
    //AFFICHER LE FORMULAIRE
    
        //si id existe
        if(id)
        {
           fetch(`index.php?ajax=menus&id=${id}`)
        
            //.then(response => response.text())
            //utilisation de la reponse
            .then(response => response.text() ) 
            .then(response => {document.getElementById("gestion").innerHTML = response;
                let selectToggle = document.getElementById('formulaire');
                selectToggle.classList.toggle("hide");
                document.getElementById("add-edit").addEventListener('click',editMenu);
                document.querySelector('.add-menus').addEventListener('click',addMenu);
            })
          
        }
        else
        {
            let selectToggle = document.getElementById('formulaire');
            selectToggle.classList.toggle("hide");  
            document.getElementById("add-edit").addEventListener('click',editMenu);
            document.querySelector('.add-menus').addEventListener('click',addMenu);
        }
    
    
}        
        
function editMenu(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('formulaire');
    // selectToggle.classList.toggle("hideMenus");
     // récupération du formulaire automatique (pour gerer les $_FILES et les POST)
        let formData = new FormData(selectToggle); 
         
        // Le premier argument du constructeur est note url, le second est un objet option
         
        fetch('index.php?ajax=editMenus',
        {
            method: 'POST',
            body: formData
        })
        
       
        //utilise la réponsephp
        .then(function() 
	    {
            showMenusTable(event); 
            selectToggle.classList.toggle("hide");  
	    })
       
}
 //Ajouter un menu       
function addMenu(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('formulaire');
    
        let formData = new FormData(selectToggle); 

        fetch('index.php?ajax=addMenu',
        {
            method: 'POST',
            body: formData
        })
        
       
        //utilise la réponsephp
        .then(function() 
	    {
            showMenusTable(event); 
            selectToggle.classList.toggle("hide");  
	    })
       
}
//Delete
	
function deleteMenus(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer le menu? Cette action est irréversible")
    if(confirm)
	{
	        let id = this.dataset.id;
	        fetch(`index.php?ajax=deleteMenus&id=${id}`)
	        
	        .then(function(){showMenusTable(event);}) 
	}
    
}

//Gestion du slider

function showSliderTable(event){
    event.preventDefault();
    fetch('index.php?ajax=slider')
    //analyser la réponse
	.then(response => response.text())
	//utilise la réponse
	.then(response => {
		document.getElementById("gestion").innerHTML = response;
		let editbtn = document.querySelectorAll('.btn-modify');
        editbtn.forEach((img)=>{
            img.addEventListener('click',showSliderForm);
        });
        let deletebtn = document.querySelectorAll('.btn-delete');
        deletebtn.forEach((img)=>{
            img.addEventListener('click',deleteSliderImg);
        });
        
        document.querySelector('.add-image').addEventListener('click',showAddSliderForm);
	});
}

function showSliderForm(event)
{
    event.preventDefault();
    let id = this.dataset.id;
    //AFFICHER LE FORMULAIRE
    let forms = document.querySelectorAll('.formulaire');
    forms.forEach((form)=>{
        if (form.dataset.id == id)
            form.classList.toggle("hide");
    });
    document.querySelectorAll(".edit-slider").forEach((img)=>{
            img.addEventListener('click',editSlider);
    });
}      

function showAddSliderForm(event)
{
    event.preventDefault();
    //AFFICHER LE FORMULAIRE
    let form = document.querySelector('#addForm');
    form.classList.toggle("hide");
    document.querySelector('.add-slider').addEventListener('click',addSliderImg);
}     

function addSliderImg(event)
{
    console.log('toto');
    event.preventDefault();
    let form = document.getElementById('addForm');
    
        let formData = new FormData(form); 
         
        fetch('index.php?ajax=addSliderImg',
        {
            method: 'POST',
            body: formData
        })
       
        //utilise la réponsephp
        .then(function() 
	    {
            showSliderTable(event); 
            form.classList.toggle("hide");  
	    });
       
}

function editSlider(event)
{
    event.preventDefault();
    let form = this.parentNode;
    console.log(form);
    // selectToggle.classList.toggle("hideMenus");
     // récupération du formulaire automatique (pour gerer les $_FILES et les POST)
        let formData = new FormData(form); 
         
        // Le premier argument du constructeur est note url, le second est un objet option
         
        fetch('index.php?ajax=editSlider',
        {
            method: 'POST',
            body: formData
        })
        
       
        //utilise la réponsephp
        .then(function() 
	    {
            showSliderTable(event); 
            form.classList.toggle("hide");  
	    })
}

function deleteSliderImg(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer cette image du slider ?")
    if(confirm)
	{
	        let id = this.dataset.id;
	        fetch(`index.php?ajax=deleteSliderImg&id=${id}`)
	        
	        .then(function(){showSliderTable(event);})
	}
}


/********************************************************/
/*                      Meals
/********************************************************/


function showMealsTable(event, id=null){
    event.preventDefault();
    fetch("index.php?ajax=meals")
    .then(response => response.text())
    .then(response => {
    document.getElementById("gestion").innerHTML = response;
    document.querySelectorAll('.editMeal')
    .forEach((menu)=>{
        menu.addEventListener('click', function (){ showMealForm(event, menu.dataset.id); });
    });
    document.querySelectorAll('.delMeal').forEach((deleteMenu)=>{
        deleteMenu.addEventListener('click', deleteMeal);
    });
    document.querySelector('.newMeal').addEventListener('click', showMealForm);
    });
}

function showMealForm(event, edit=null)
{
    if (edit != null)
    {
        fetch(`index.php?ajax=meals&id=${edit}`)
        .then(response => response.text())
        .then(response => {
            document.getElementById("gestion").innerHTML = response;
            let selectToggle = document.getElementById('mealForm');
            selectToggle.classList.toggle("hide");
            document.getElementById("addEdit").addEventListener('click',editMeal);
            document.getElementById('addMeal').addEventListener('click',addMeal);
        })
    }
    else
    {
        let selectToggle = document.getElementById('mealForm');
        selectToggle.classList.toggle("hide");
        document.getElementById("addEdit").addEventListener('click',editMeal);
        document.getElementById('addMeal').addEventListener('click',addMeal);
    }
}

function editMeal(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('mealForm');
    let formData = new FormData(selectToggle); 
    fetch('index.php?ajax=editMeal',
    {
        method: 'POST',
        body: formData,
    })
    .then( function() {
        showMealsTable(event); 
        selectToggle.classList.toggle("hide");  
    })
 
}
function addMeal(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('mealForm');
    let formData = new FormData(selectToggle);
    fetch('index.php?ajax=addMeal',
    {
        method: 'POST',
        body: formData,
    })
    .then(function() 
    {
        showMealsTable(event); 
        selectToggle.classList.toggle("hide");  
    })
}

function deleteMeal(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer le plat? Cette action est irréversible")
    if(confirm)
	{
        let id = this.dataset.id;
        fetch(`index.php?ajax=delMeal&id=${id}`)
        .then( function(){
            showMealsTable(event);
        }) 
	}
    
}


/********************************************************/
/*                      DOM
/********************************************************/

//     ///////////////// ACCUEIL  ///////////////// //
// fonction pour afficher le contenu du dashbord en ajax 
function showAccueilTable(event){
    event.preventDefault();
    fetch("index.php?ajax=accueil")
    .then(response => response.text())
    //utilise la réponse
    .then(response => {
        //on affiche dans le phtml de dashboard id gestion
        document.getElementById("gestion").innerHTML = response;
        //sur quel bouton il clic
        let modifaccueil = document.querySelectorAll('.btn-accueil')
        modifaccueil.forEach((accu)=>{
            accu.addEventListener('click',showFormAccueil);
        })
        let delAccueil = document.querySelectorAll('.sup-accueil')
        delAccueil.forEach((deleteacc)=>{
            deleteacc.addEventListener('click',deleteAccueil);
        })
        
        document.querySelector('.add-one-accueil').addEventListener('click',showFormAccueil);
    });   
     
}

function showFormAccueil(event)
{
    event.preventDefault();
    let id = this.dataset.id;
    //AFFICHER LE FORMULAIRE
    let selectToggle = document.getElementById('formulaire');
    selectToggle.classList.toggle("hide");
        
        fetch(`index.php?ajax=getAccueil&id=${id}`)
        
        
        //.then(response => response.text())
        //utilisation de la reponse
        .then(function(){
       
        })
    document.getElementById("add-edit-accueil").addEventListener('click',editAccueil);
    
    document.querySelector('.add-accueil').addEventListener('click',addAccueil);
}        
        
function editAccueil(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('formulaire');
   
        let formData = new FormData(selectToggle); 

        fetch('index.php?ajax=editAccueil',
        {
            method: 'POST',
            body: formData
        })
        
        //utilise la réponsephp
        .then(function() 
	    {
            showAccueilTable(event); 
            selectToggle.classList.toggle("hide");  
	    })
       
}
    
function addAccueil(event)
{
    event.preventDefault();
    let selectToggle = document.getElementById('formulaire');
    
        let formData = new FormData(selectToggle); 
        fetch('index.php?ajax=addAccueil',
        {
            method: 'POST',
            body: formData
        })
      
        //utilise la réponsephp
        .then(function() 
	    {
            showAccueilTable(event); 
            selectToggle.classList.toggle("hide");  
	    })
       
}
//Delete
	
function deleteAccueil(event)
{
    event.preventDefault();
    let confirm = window.confirm("Voulez-vous supprimer le contenu? Cette action est irréversible")
    if(confirm)
	{
	        let id = this.dataset.id;
	        fetch(`index.php?ajax=deleteAccueil&id=${id}`)
	        
	        .then(function(){showAccueilTable(event);}) 
	}
    
}



document.addEventListener("DOMContentLoaded",function(){
    document.getElementById('gestionAccueil').addEventListener('click',showAccueilTable);
    document.getElementById('gestionCategory').addEventListener("click", showCategoryTable);
    document.getElementById('gestionBooking').addEventListener('click',showBookingTable);
    document.getElementById('gestionMenus').addEventListener('click',showMenusTable);
    document.getElementById('gestionSlider').addEventListener('click',showSliderTable);
    document.getElementById('gestionMeals').addEventListener('click',showMealsTable);

});
