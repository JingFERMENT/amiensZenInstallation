// ouvrir la modal delete comment
$('.modalOpenCommentDeleteBtn').on("click", showConfirmationCommentDeletePopup);
// cliquer 'oui' dans la page modal delete subscriber
$(".deleteCommentBtn").on("click", doDeleteComment);

// function category
function showConfirmationCommentDeletePopup(event) {
    const clickedCommentId = ($(this).data('id'));
    // attribuer une valeur à l'attribut 'data-id'
    $(".deleteCommentBtn").attr('data-id', clickedCommentId);
}

function doDeleteComment(event) {
    //cibler la data-id sur la bouton "oui" de modal
    let commentId = $(this).data('id');
    window.location.href = "/controllers/dashboard/comment/delete-ctrl.php?id_comment=" + commentId;
}