const titleInput = document.getElementById("title");

const automotiveCategory = document.querySelector("label.automotive");
const clothesCategory = document.querySelector("label.clothes");
const electronicsCategory = document.querySelector("label.electronics");
const musicCategory = document.querySelector("label.music-accessories");

const description = document.getElementById("description");
const price = document.getElementById("price");

const addAdvertBtn = document.getElementById("add-advert-btn");
const advertForm = document.getElementById("advert-form");

const automotiveTab = document.querySelector("aside.automotive-tab");
const electronicsTab = document.querySelector("aside.electronics-tab");
const musicTab = document.querySelector("aside.music-accessories-tab");
const clothesTab = document.querySelector("aside.clothes-tab");

const sectionAdvert = document.querySelector("section.add-advert");

const automotiveBtn = document.querySelector("aside button");
const clothesBtn = document.querySelector("aside button.clothes-btn");
const electronicsBtn = document.querySelector("aside button.electronics-btn");
const musicBtn = document.querySelector("aside button.music-btn");


/*Wysunięcie panelu z wybraną kategorią*/


showAutomotiveTab = () => {
    automotiveTab.classList.add("show");
}

showClothesTab = () => {
    clothesTab.classList.add("show");
}

showElectronicsTab = () => {
    electronicsTab.classList.add("show");
}

showMusicTab = () => {
    musicTab.classList.add("show");
}

hideAutomotiveTab = () => {
    automotiveTab.classList.remove("show");
}

hideClothesTab = () => {
    clothesTab.classList.remove("show");
}

hideElectronicsTab = () => {
    electronicsTab.classList.remove("show");
}

hideMusicTab = () => {
    musicTab.classList.remove("show");
}


automotiveCategory.addEventListener("click", showAutomotiveTab);
clothesCategory.addEventListener("click", showClothesTab);
musicCategory.addEventListener("click", showMusicTab);
electronicsCategory.addEventListener("click", showElectronicsTab);

automotiveBtn.addEventListener("click", hideAutomotiveTab);
clothesBtn.addEventListener("click", hideClothesTab);
electronicsBtn.addEventListener("click", hideElectronicsTab);
musicBtn.addEventListener("click", hideMusicTab);


/*Walidacja*/


advertForm.onsubmit = function validateAdvert() {
    if (titleInput.value.length < 6) {
        window.alert("Fill title field properly ! Your title must have more than 6 characters!");
        titleInput.focus();
        return false;
    }

    if (description.value.length < 30) {
        window.alert("Fill desrciption field properly ! Your description must have more than 30 characters!");
        description.focus();
        return false;
    }

    if (price.value.length === "") {
        window.alert("Fill price field properly ! Your price cannot be empty!");
        description.focus();
        return false;
    }
}

addAdvertBtn.addEventListener("click", validateAdvert);




