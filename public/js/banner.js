
const images = document.querySelectorAll('#banner img');
let index = 0;

function changeImage() {
    images.forEach(img => {
        img.style.opacity = 0;
    });
    index = (index + 1) % images.length;
    images[index].style.opacity = 1;
}

setInterval(changeImage, 3000); // Cambiar imagen cada 3 segundos
