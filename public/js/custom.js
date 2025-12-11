// Function untuk Intersection Observer
document.addEventListener('DOMContentLoaded', function() {
    const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');

    const observerOptions = {
        root: null, // viewport
        rootMargin: '0px',
        threshold: 0.2 // Trigger saat 20% elemen terlihat
    };

    function handleIntersect(entries, observer) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target); // Stop observing setelah animasi
            }
        });
    }

    const observer = new IntersectionObserver(handleIntersect, observerOptions);

    elementsToAnimate.forEach(element => {
        observer.observe(element);
    });
});