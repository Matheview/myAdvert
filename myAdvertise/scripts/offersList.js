const offersWrap = document.querySelector("div.offers-wrap");
const uniqueOffer = document.createElement("div");
const offerTitle = document.createElement("h1");
const offerDescription = document.createElement("p");
const offerLocalisation = document.createElement("p");
const mainOfferImg = document.createElement("img");

/*Tu musi być if -> Jeśli w bazie, w pzeszukiwanej kategorii są jakieś ogłoszenia to wykonaj funkcję setUniqueOfferInfo(); Jeśli nie ma ogłoszeń to wykonaj funkcję emptyOffers()*/

const emptyOffers = () => {
    alert("There are no offers at the moment!");
}


const setUniqueOfferInfo = () => {
    offerTitle.textContent = "Sprzedam Forda"; /*Tu dałem przykładowe dane - pasuje żebyś Mati tu jakoś przypisywał wartośći z bazy*/
    offerDescription.textContent = "No fordzik elegancki, 100 tys. przebiegu rok 2010 "; /*Tu dałem przykładowe dane - pasuje żebyś Mati tu jakoś przypisywał wartośći z bazy*/
    offerLocalisation.textContent = "Mielec"; /*Tu dałem przykładowe dane - pasuje żebyś Mati tu jakoś przypisywał wartośći z bazy*/
    mainOfferImg.src = "offers_picture/automotive/28/fordfiesta.webp"; /*Tu dałem przykładowe dane - pasuje żebyś Mati tu jakoś przypisywał wartośći z bazy*/
}






/*Funkcja do przypisania do zmiennych w DOM na stronie wartości z bazy*/

setUniqueOfferInfo();


/*Funckja "budująca widok" na stronie*/


const buildCurrentOffer = () => {
    uniqueOffer.appendChild(mainOfferImg);
    uniqueOffer.appendChild(offerTitle);
    uniqueOffer.appendChild(offerDescription);
    uniqueOffer.appendChild(offerLocalisation);
    offersWrap.appendChild(uniqueOffer);
}


buildCurrentOffer();


/*Spróbuj Mati narazie zobaczyć czy doda jedno ogłoszenie poprawnie. Jak zadziała, to zrobimy pętlę i wszystkie oferty będziemy wrzucać do tablicy i ona będzie wyświetlana na stronie w postaci ogłoszeń - taki mam pomysł, ale muszę się jeszcze z tym przespać */