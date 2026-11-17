// Grab the page elements we need
const locateBtn   = document.getElementById("locateBtn");
const checkInBtn  = document.getElementById("checkInBtn");
const checkOutBtn = document.getElementById("checkOutBtn");
const statusBox   = document.getElementById("status");
const workerName  = document.getElementById("workerName");

// Will hold the worker's position once we have it
let currentPosition = null;

locateBtn.addEventListener("click", function () {
  // navigator.geolocation is built into the browser
  if (!navigator.geolocation) {
    statusBox.textContent = "Your browser does not support location.";
    return;
  }

  statusBox.textContent = "Getting your location...";

  navigator.geolocation.getCurrentPosition(
    function (position) {
      currentPosition = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
        accuracy: position.coords.accuracy
      };

      statusBox.textContent =
        "Location found: " +
        currentPosition.lat.toFixed(5) + ", " +
        currentPosition.lng.toFixed(5) +
        " (accuracy " + Math.round(currentPosition.accuracy) + " m)";

      // For now, enable both buttons. The server will decide later.
      checkInBtn.disabled  = false;
      checkOutBtn.disabled = false;
    },
    function (error) {
      statusBox.textContent = "Could not get location: " + error.message;
    },
    { enableHighAccuracy: true, timeout: 15000 }
  );
});

checkInBtn.addEventListener("click", function () {
  sendEvent("IN");
});
checkOutBtn.addEventListener("click", function () {
  sendEvent("OUT");
});

function sendEvent(type) {
  // We'll connect this to api/check_in.php after the database is ready
  console.log("Would send:", type, workerName.value, currentPosition);
  statusBox.textContent = "Ready to send " + type + " (server not connected yet).";
}