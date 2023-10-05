let btn = document.getElementById("btn-calculate")

const success = (data) =>{
    var current_lat = data.coords.latitude;
    var current_lon = data.coords.longitude
    var latitude = document.getElementById("latitude")
    var longitude = document.getElementById("longitude")
    latitude.value = current_lat
    longitude.value = current_lon
    console.log(current_lat,current_lon);
}

btn.addEventListener("click", () => {
    console.log("hey")
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };
    navigator.geolocation.getCurrentPosition(
        success,
        console.error("erreur"),
        options
    )
})