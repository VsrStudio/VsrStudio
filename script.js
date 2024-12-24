// Script untuk menambahkan animasi saat halaman dimuat
document.addEventListener("DOMContentLoaded", () => {
    const heroElements = document.querySelectorAll(".hero h1, .hero p");
    heroElements.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.5}s`;
    });
});

document.querySelectorAll(".btn").forEach(button => {
    button.addEventListener("mouseenter", () => {
        button.style.transform = "scale(1.05)";
    });

    button.addEventListener("mouseleave", () => {
        button.style.transform = "scale(1)";
    });
});

function searchPlugin() {
    var input, filter, cards, card, title, i;
    input = document.getElementById('searchInput');
    filter = input.value.toLowerCase();
    cards = document.getElementsByClassName('plugin-card');

    for (i = 0; i < cards.length; i++) {
        card = cards[i];
        title = card.getElementsByTagName('h3')[0];

        if (title.innerHTML.toLowerCase().indexOf(filter) > -1) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    }
}
