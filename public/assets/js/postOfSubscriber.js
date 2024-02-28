// ouvrir la modal delete subscriber
$('.modalOpenPostOfSubscriberDeleteBtn').on("click", showConfirmationSubscriberDeletePopup);
// cliquer 'oui' dans la page modal delete subscriber
$(".deletePostOfSubscriberBtn").on("click", doDeleteSubscriber);

// function subscriber
function showConfirmationSubscriberDeletePopup(event) {
    const clickedPostId = ($(this).data('id'));
    // attribuer une valeur à l'attribut 'data-id'
    $(".deletePostOfSubscriberBtn").attr('data-id', clickedPostId);
}

function doDeleteSubscriber(event) {
    //cibler la data-id sur la bouton "oui" de modal
    let postId = $(this).data('id');
    window.location.href = "/controllers/subscriber/delete-post-ctrl.php?id_post=" + postId;
}