/* SKRYPTY STRONA GŁÓWNA */
const accountBtn = document.querySelector("p.account");
const accountTab = document.querySelector("div.account-info");

toggleShowTab = () => {
    accountTab.classList.toggle("active");
}

accountBtn.addEventListener("click", toggleShowTab);