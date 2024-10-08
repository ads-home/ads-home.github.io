let currentImageIndex = 0; // تعريف المتغير مرة واحدة
let images = [];

window.addEventListener('DOMContentLoaded', event => {
    function loadImages(projectNumber) {
        fetch(`get_images.php?project=${projectNumber}`)
            .then(response => response.json())
            .then(images => {
                const carouselInner = document.querySelector(`#carouselProject${projectNumber} .carousel-inner`);

                images.forEach((image, index) => {
                    const img = document.createElement('img');
                    // تحديث المسار للمجلد الجديد
                    img.src = `assets/img/portfolio/fullsize/بوسترات-مدرسين/${image}`; // تغيير المسار للمجلد الجديد
                    img.classList.add('d-block', 'w-100');
                    
                    const carouselItem = document.createElement('div');
                    carouselItem.classList.add('carousel-item');
                    if (index === 0) {
                        carouselItem.classList.add('active');
                    }
                    carouselItem.appendChild(img);
                    carouselInner.appendChild(carouselItem);
                });
            })
            .catch(error => console.error('Error loading images:', error));
    }

    loadImages(1);
    loadImages(2);
    loadImages(3);
    loadImages(4); // تأكد من استخدام الرقم الصحيح للمجلد الجديد
    loadImages(5);
    loadImages(6);
});

function openFullscreen(imgElement, projectNumber) {
    const modal = document.getElementById('fullscreenModal');
    const fullscreenImage = document.getElementById('fullscreenImage');
    modal.style.display = 'flex';

    // جلب الصور من الخادم
    fetch(`get_images.php?project=${projectNumber}`)
        .then(response => response.json())
        .then(data => {
            // تحديث المسار للمجلد الجديد
            images = data.map(image => `assets/img/portfolio/fullsize/بوسترات-مدرسين/${image}`); // تغيير المسار للمجلد الجديد
            currentImageIndex = images.indexOf(imgElement.src);
            fullscreenImage.src = imgElement.src;
        });

    // إضافة مستمع للنقر على النافذة لإغلاقها
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeFullscreen();
        }
    });
}

function closeFullscreen() {
    const modal = document.getElementById('fullscreenModal');
    modal.style.display = 'none';
}