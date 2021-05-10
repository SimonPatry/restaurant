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
    event.preventDefault();
    let tr = this.parentNode.parentNode;
    fetch(`index.php?ajax=delCat&id=${tr.id}`)
    .then(response => {
        showCategoryTable();
    });
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

    fetch(`index.php?ajax=addCat`, options)
    .then( function (){
	    showCategoryTable();
    })
}

function editCategory(){
    event.preventDefault();
    let tr = this.parentNode.parentNode;
    tr.classList.toggle("hide");
    if (tr.dataset.id == 1){
        console.log("hihi");
        tr.nextElementSibling.classList.toggle("hide");
        cat = document.getElementById(tr.id);
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
        
        
        fetch(`index.php?ajax=editCat`, options)
        .then( function (){
		    showCategoryTable();
	    })
    }
    else{
        tr.previousElementSibling.classList.toggle("hide");
    }
}

document.addEventListener("DOMContentLoaded",function(){
    document.getElementById('gestionCategory').addEventListener("click", showCategoryTable);
    
});