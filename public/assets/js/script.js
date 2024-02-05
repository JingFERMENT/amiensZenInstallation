//jquery

// attention de récupéer les id_category dans la bouton oui du modal

// ouvrir la modal delete
$('.modalOpenSubscriberDeleteBtn').on("click", showConfirmationSubscriberDeletePopup);
// cliquer 'oui' dans la page modal delete
$(".deleteSubscriberBtn").on("click", doDeleteSubscriber);


function showConfirmationSubscriberDeletePopup(event) {
    const clickedSubscriberId = ($(this).data('id'));
    // attribuer une valeur à l'attribut 'data-id'
    $(".deleteSubscriberBtn").attr('data-id', clickedSubscriberId);
}

function doDeleteSubscriber(event) {
    //cibler la data-id sur la bouton "oui" de modal
    let subscriberId = $(this).data('id');
    window.location.href = "/controllers/dashboard/subscriber/delete-ctrl.php?id_subscriber=" + subscriberId;
}
