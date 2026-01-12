document.addEventListener('DOMContentLoaded', () => {
    // Header Scroll Effect
    const header = document.querySelector('.site-header');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
        } else {
            header.style.boxShadow = '0 2px 8px rgba(0,0,0,0.05)';
        }
    });

    // Simple Wishlist Toggle
    const wishlistBtns = document.querySelectorAll('.wishlist-btn');
    wishlistBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const icon = btn.querySelector('i');
            if (icon.classList.contains('fa-regular')) {
                icon.classList.remove('fa-regular');
                icon.classList.add('fa-solid');
                icon.style.color = '#d11e64'; // Accent color
            } else {
                icon.classList.remove('fa-solid');
                icon.classList.add('fa-regular');
                icon.style.color = '';
            }
        });
    });


    // --- Spotlight Auto Slider ---
    const spotlightWrapper = document.getElementById('spotlightWrapper');
    if (spotlightWrapper) {
        let scrollAmount = 0;
        const cardWidth = spotlightWrapper.querySelector('.spotlight-card').offsetWidth + 30; // Card width + gap
        const maxScroll = spotlightWrapper.scrollWidth - spotlightWrapper.clientWidth;

        function autoScrollSpotlight() {
            if (scrollAmount >= maxScroll) {
                // If reached end, scroll back to start smoothly (or instantly if preferred)
                spotlightWrapper.scrollTo({ left: 0, behavior: 'smooth' });
                scrollAmount = 0;
            } else {
                scrollAmount += cardWidth;
                spotlightWrapper.scrollBy({ left: cardWidth, behavior: 'smooth' });
            }
        }

        // Auto slide every 3 seconds
        let slideInterval = setInterval(autoScrollSpotlight, 3000);

        // Pause on hover
        spotlightWrapper.addEventListener('mouseenter', () => {
            clearInterval(slideInterval);
        });

        // Resume on mouse leave
        spotlightWrapper.addEventListener('mouseleave', () => {
            slideInterval = setInterval(autoScrollSpotlight, 3000);
        });

        // Update functionality for manual buttons to also reset timer
        const controlBtns = document.querySelectorAll('.control-btn');
        controlBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                clearInterval(slideInterval);
                // Restart after a slightly longer delay to avoid fighting the user
                setTimeout(() => {
                    clearInterval(slideInterval); // Ensure clear
                    slideInterval = setInterval(autoScrollSpotlight, 3000);
                }, 5000);
            });
        });
    }
});
