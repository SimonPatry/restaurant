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
    });   
     
}

function showForm(event)
{
    event.preventDefault();
    let id = this.dataset.id;
    //AFFICHER LE FORMULAIRE
    let selectToggle = document.getElementById('formulaire');
    selectToggle.classList.toggle("hideMenus");
        
        fetch(`index.php?ajax=getMenu&id=${id}`)
        
        
        //.then(response => response.text())
        //utilisation de la reponse
        .then(function(){
           
        })
   document.getElementById("add-edit").addEventListener('click',editMenu);
   
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
            selectToggle.classList.toggle("hideMenus");  
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


//DOM

document.addEventListener("DOMContentLoaded",function(){
	document.getElementById('gestionMenus').addEventListener('click',showMenusTable);
	
})