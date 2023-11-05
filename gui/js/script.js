const hamburgerButton = document.querySelector(".hamburger")
const navigation = document.querySelector("nav")

hamburgerButton.addEventListener ("click", toggleNav)

function toggleNav() {
    hamburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}

const searchBar = document.querySelector("#searchbar");
const cards = document.querySelectorAll(".card");

searchBar.addEventListener("keyup", (e) => {
    const searchedLetters = e.target.value;
    filterElements(searchedLetters, cards);
});

function filterElements(letters, elements) {
    if (letters.length > 2) {
        for (let i = 0; i < elements.length; i++) {
            if (elements[i].textContent.toLowerCase().includes(letters)) {
                elements[i].style.display = "block";
            } else {
                elements[i].style.display = "none";
            }
        }
    } else if (letters.length === 0) {
        // Si la barre de recherche est vide, réaffiche tous les éléments
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.display = "block";
        }
    }
}
