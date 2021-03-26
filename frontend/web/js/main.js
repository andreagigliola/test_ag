function openModal(dessert, ingredients) {
    $("#Modal").show();

    $("#Modal .modal-header h1").text(dessert + ' ingredients');
    $("#Modal .modal-body #ingredients-list").text(ingredients);
}