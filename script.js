// ensure DOM elements exist before attaching listeners
window.addEventListener('DOMContentLoaded', () => { 
    const btn = document.getElementById("btn");
    const cardin = document.getElementById("cardin"); 
    const clBtn = document.getElementById("clBtn");
 
    if (!btn || !cardin || !clBtn) {
        console.error("Required elements not found: btn, cardin, or clBtn");
        return;
    }

    // toggle the card's visibility when the sign-up button is clicked
    btn.addEventListener('click', () => {
        if (cardin.style.display === "flex" || cardin.style.display === "block") {
            cardin.style.display = "none"; 
        } else {
            alert("You have successfully signed up!"); // show alert on sign-up
            cardin.style.display = "flex"; // or block depending on layout
        }
    });

    // close button always hides the card
    clBtn.addEventListener('click', () => {
        cardin.style.display = "none";
    });
});




