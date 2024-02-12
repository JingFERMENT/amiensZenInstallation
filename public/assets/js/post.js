// ouvrir la modal delete post
$('.modalOpenPostDeleteBtn').on("click", showConfirmationPostDeletePopup);
// cliquer 'oui' dans la page modal delete post
$(".deletePostBtn").on("click", doDeletePost);

// function post
function showConfirmationPostDeletePopup(event) {
    const clickedPostId = ($(this).data('id'));
    // attribuer une valeur à l'attribut 'data-id'
    $(".deletePostBtn").attr('data-id', clickedPostId);
}

function doDeletePost(event) {
    //cibler la data-id sur la bouton "oui" de modal
    let postId = $(this).data('id');
    window.location.href = "/controllers/dashboard/post/delete-ctrl.php?id_post=" + postId;
}