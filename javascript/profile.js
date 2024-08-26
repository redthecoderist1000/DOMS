function formatDate(date) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString(undefined, options);
}

window.onload = function() {
    const dateElement = document.getElementById('currentDate');
    const today = new Date();
    dateElement.textContent = formatDate(today);
};

var modal = document.getElementById("studentProfileModal");

var btn = document.getElementById("viewProfileBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
