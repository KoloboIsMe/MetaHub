const hamburgerButton = document.querySelector(".hamburger")
const navigation = document.querySelector("nav")

hamburgerButton.addEventListener("click", toggleNav)

function toggleNav() {
    hamburgerButton.classList.toggle("active")
    navigation.classList.toggle("active")
}


const searchBar = document.querySelector("#searchbar");

searchBar.addEventListener("keyup", (e) => {
    const searchedLetters = e.target.value;

    let selector = "";
    if (document.querySelectorAll(".post-card").length !== 0) {
        selector = ".post-card";
    } else if (document.querySelectorAll(".card").length !== 0) {
        selector = ".card";
    } else if (document.querySelectorAll(".category-card").length !== 0){
        selector = ".category-card";
    }else if(document.querySelectorAll(".users-card").length !== 0) {
        selector = ".users-card";
    }
    const cards = document.querySelectorAll(selector);

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
        for (let i = 0; i < elements.length; i++) {
            elements[i].style.display = "block";
        }
    }
}
