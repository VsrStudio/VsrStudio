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
