function initMap() {

    var langS=parseFloat(document.getElementById('lang').value);
    var latS= parseFloat(document.getElementById('lat').value);

    console.log(langS);
    console.log(latS);
    // The location of Uluru
    const uluru = { lat:langS, lng: latS };
    // The map, centered at Uluru
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 18,
        center: uluru,
    });
    // The marker, positioned at Uluru
    const marker = new google.maps.Marker({
        position: uluru,
        map: map,
    });
}
