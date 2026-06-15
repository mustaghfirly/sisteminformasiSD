let images = document.querySelectorAll(".gallery-img");
let currentIndex = 0;

function openModal(index) {
    currentIndex = index;
    document.getElementById("imageModal").style.display = "block";
    document.getElementById("modalImage").src = images[currentIndex].src;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

function changeImage(step) {
    currentIndex += step;

    if (currentIndex < 0) currentIndex = images.length - 1;
    if (currentIndex >= images.length) currentIndex = 0;

    document.getElementById("modalImage").src = images[currentIndex].src;
}
