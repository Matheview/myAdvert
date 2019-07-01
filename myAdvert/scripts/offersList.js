const selectedOption = document.getElementById("selected-option");
const filter = document.getElementById("sort");
var toSort = document.getElementById('just-check').children;
toSort = Array.prototype.slice.call(toSort, 0);


const checkFilterValue = () => {
    if (filter.value === "newest") {
        toSort.sort(function (a, b) {
            return (Date.parse($(a).attr('data-offer')) < Date.parse($(b).attr('data-offer'))) ? 1 : -1;
        });
        var parent = document.getElementById('just-check');
        parent.innerHTML = "";

        for (var i = 0, l = toSort.length; i < l; i++) {
            parent.appendChild(toSort[i]);
        }
    }

    else if (filter.value === "oldest") {
        toSort.sort(function (a, b) {
            return (Date.parse($(a).attr('data-offer')) > Date.parse($(b).attr('data-offer'))) ? 1 : -1;
        });
        var parent = document.getElementById('just-check');
        parent.innerHTML = "";

        for (var i = 0, l = toSort.length; i < l; i++) {
            parent.appendChild(toSort[i]);
        }
    }

    else if (filter.value === "highprice") {
        toSort.sort(function (a, b) {
            return (parseInt($(a).attr('price-offer')) < parseInt($(b).attr('price-offer'))) ? 1 : -1;
        });
        var parent = document.getElementById('just-check');
        parent.innerHTML = "";

        for (var i = 0, l = toSort.length; i < l; i++) {
            parent.appendChild(toSort[i]);
        }
    }

    else if (filter.value === "lowprice") {
        toSort.sort(function (a, b) {
            return (parseInt($(a).attr('price-offer')) > parseInt($(b).attr('price-offer'))) ? 1 : -1;
        });
        var parent = document.getElementById('just-check');
        parent.innerHTML = "";

        for (var i = 0, l = toSort.length; i < l; i++) {
            parent.appendChild(toSort[i]);
        }
    }

    else {
        console.log("Nie działa jak trzeba !");
    }

}

function sortoffer(a, b) {
    return a.className < b.className;
}
