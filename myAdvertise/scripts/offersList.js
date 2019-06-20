const selectedOption = document.getElementById("selected-option");
const filter = document.getElementById("sort");

/* Tu masz wykrywanie zmiany stanu selecta filtra :D */


const checkFilterValue = () => {
    if (filter.value === "newest") {
        console.log("nowe oferty");
    }

    else if (filter.value === "oldest") {
        console.log("stare oferty");
    }

    else if (filter.value === "highprice") {
        console.log("ceny od najwyższej");
    }

    else if (filter.value === "lowprice") {
        console.log("ceny od najniższej");
    }

    else {
        console.log("Nie działa jak trzeba !");
    }

}
