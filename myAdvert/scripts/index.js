
const accountBtn = document.querySelector("p.account");
const accountTab = document.querySelector("div.account-info");
const brand = document.querySelector("div.brand");
const model = document.querySelector("div.model");
const year = document.querySelector("div.year");
const mileage = document.querySelector("div.mileage");
const engine = document.querySelector("div.engine");
const condition = document.querySelector("div.condition");
const price = document.querySelector("div.price");
const userName = document.querySelector("div.user-name");
const phoneNumber = document.querySelector("div.phone-number");
const localisation = document.querySelector("div.localisation");
const date = document.querySelector("div.date");
const colour = document.querySelector("div.colour");
const sex = document.querySelector("div.sex");
const size = document.querySelector("div.size");



toggleShowTab = () => {
    accountTab.classList.toggle("active");
}

accountBtn.addEventListener("click", toggleShowTab);

brand.textContent += " | Brand";



condition.textContent += " | Condition";
price.textContent += " | Price";
userName.textContent += " | User";
phoneNumber.textContent += " | Phone number";
localisation.textContent += " | Localisation";
date.textContent += " | Date";
colour.textContent += " | Colour";
sex.textContent += " | Sex";
size.textContent += " | Size";
