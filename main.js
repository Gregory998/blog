const messageContainer = document.getElementById('message-container');

regenEvent();

 

function regenEvent() {
    let btns  = document.querySelectorAll('.delete');
    btns.forEach( btn => {
        console.log('coucou')
        btn.addEventListener('click', function() {
            console.log('coucou')
            let id = this.dataset.id;
            ajax(id);
    })})
}


async function ajax(id){

    const formdata = new FormData();
    // Pour récuper l'id dans delete_ctrl.php, je devrais ecrire $_POST['id']
    formdata.append('id', id);

    // on envoie un formulaire en method post mais au format ajax
    let data = {
        method: "POST",
        body: formdata
    }

    // On envoie l'id dans le fichier delete_ctrl_.php et on attend la reponse.
    let rep = await fetch('delete_ctrl.php', data);
    let response = await rep.json();
    
    if (typeof(response.regen) != "undefined") {
        messageContainer.innerHTML = "";
        messageContainer.innerHTML = response.regen;
        regenEvent();
    }
}


const btnlike = document.querySelectorAll('.like');
const msglike = document.getElementById('msglike');

btnlike.forEach(button => {
    button.addEventListener('click', function () {
        const messageId = this.dataset.id;
        ajaxLike(messageId);
    });
});

function ajaxLike(messageId) {
    const data = new FormData();
    data.append('like_msg', 1);
    data.append('id', messageId);

    const sendData = {
        method: "POST",
        body: data
    }

    fetch('like.php', sendData)  // Assurez-vous d'envoyer la requête à like.php
        .then(response => response.json())
        .then(responseData => {
            console.log(responseData);
            msglike.innerHTML = responseData.newQuantityLike;
        })
        .catch(error => {
            console.error('Erreur', error);
        });
}




