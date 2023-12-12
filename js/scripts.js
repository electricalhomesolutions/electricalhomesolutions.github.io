/*!
* Start Bootstrap - Scrolling Nav v5.0.6 (https://startbootstrap.com/template/scrolling-nav)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-scrolling-nav/blob/master/LICENSE)
*/

// Scripts

window.addEventListener('DOMContentLoaded', event => {

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

    // Handle form submission
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault();

        // Execute reCAPTCHA and get the token
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfTWS4pAAAAAFg10BIvgojWi_UIcfjUSKV6w3HC', {action: 'submit'}).then(function(token) {
                // Add the token to the form data
                var formData = {
                    firstName: document.getElementById('firstName').value,
                    lastName: document.getElementById('lastName').value,
                    email: document.getElementById('email').value,
                    message: document.getElementById('message').value,
                    recaptchaResponse: token  // reCAPTCHA response token
                };

                // AJAX request to PHP script
                fetch('/electric-al-website/send_mail.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                })
                .then(response => response.text())
                .then(data => {
                    alert('Message sent successfully!');
                    grecaptcha.reset(); // Reset the reCAPTCHA widget
                })
                .catch((error) => {
                    console.error('Error:', error);
                    grecaptcha.reset(); // Reset the reCAPTCHA widget
                });
            });
        });
    });
});



