// ouvrir la modal delete category
$('.modalOpenCategoryDeleteBtn').on("click", showConfirmationCategoryDeletePopup);
// cliquer 'oui' dans la page modal delete subscriber
$(".deleteCategoryBtn").on("click", doDeleteCategory);

// function category
function showConfirmationCategoryDeletePopup(event) {
    const clickedCategoryId = ($(this).data('id'));
    // attribuer une valeur à l'attribut 'data-id'
    $(".deleteCategoryBtn").attr('data-id', clickedCategoryId);
}

function doDeleteCategory(event) {
    //cibler la data-id sur la bouton "oui" de modal
    let categoryId = $(this).data('id');
    window.location.href = "/controllers/dashboard/category/delete-ctrl.php?id_category=" + categoryId;
}