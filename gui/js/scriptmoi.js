document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("myForm");
    const categorieSelect = document.getElementById("categorie");
    const ajouterMotButton = document.getElementById("ajouterMot");
    const listeMots = document.getElementById("listeMots");
    const mots = document.getElementById("mots");

    ajouterMotButton.addEventListener("click", function() {
        const selectedCategorie = categorieSelect.value;
        const selectedCategorieText = categorieSelect.options[categorieSelect.selectedIndex].text;

        for (let i = 0; i < listeMots.children.length; i++) {
            const mot = listeMots.children[i];
            if (mot.textContent === "#"+selectedCategorieText) {
                alert("Cette catégorie est déjà dans la liste");
                return;
            }
        }
        listeMots.innerHTML += `<li>#${selectedCategorieText}</li>`;
        mots.value += `${selectedCategorie} `;

    });
});