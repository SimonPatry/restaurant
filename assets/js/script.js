function hideCookies()
{
    document.querySelector('.cookies').classList.add('hide');
}


function acceptAllCookies()
{
   fetch('index.php?cookie=all')
   .then(function() {hideCookies();})
}


function rejectAllCookies()
{
    fetch('index.php?cookie=none')
   .then(function() {hideCookies();})
}

function acceptCookies()
{
  
   let  cookies = {
        fonctionnel:document.getElementById("cookies-fonctionnel").value,
        pub: document.getElementById("cookies-pub").value,
        suivis: document.getElementById("cookies-suivis").value,
        
    }
    //transforme cet objet en un json
    cookies = JSON.stringify(cookies);

    //options
    let options = {
        method : 'POST',
        body : cookies,
        headers:{'Content-Type':'application/json'}
    }

    fetch('index.php?cookie=personalized',options)
    .then(function() {hideCookies();})

}



document.addEventListener("DOMContentLoaded",function(){
    document.getElementById('accept-cookies').addEventListener('click',acceptCookies);
    document.getElementById('reject-all').addEventListener('click',rejectAllCookies);
    document.getElementById('accept-all').addEventListener('click',acceptAllCookies);
});
