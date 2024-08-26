document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById("myModal");
    const span = document.getElementsByClassName("close")[0];

    document.querySelectorAll('.person').forEach(person => {
        person.addEventListener('click', () => {
            modal.style.display = "block";
        });
    });

    span.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
