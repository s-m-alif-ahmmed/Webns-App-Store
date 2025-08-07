// Left side social icons and right side subscribe buttons visibility
$(document).ready(function () {
    // Hide the full subscribe box initially
    $('#subscribe-box').hide();

    // Event listener for clicking the little subscribe box
    $('#subscribe-little-box').click(function () {
        $('#subscribe-box').show();
        $('#subscribe-little-box').hide();
    });

    // Event listener for clicking the close button in the subscribe box
    $('#subscribe-box-canle').click(function () {
        $('#subscribe-box').hide();
        $('#subscribe-little-box').show();
    });

    // Event listener for scrolling
    $(window).scroll(function () {
        var scrollPosition = $(this).scrollTop();
        var footerTop = $('footer').offset().top;
        var windowHeight = $(window).height();

        // Check if the scroll position is above the footer
        if (scrollPosition + windowHeight <= footerTop) {
            $('#left-social-icons').show();

            // Check if the little subscribe box is visible
            if ($('#subscribe-box').is(':visible')) {
                $('#subscribe-little-box').hide();
            } else {
                $('#subscribe-little-box').show();
            }

        } else {
            $('#left-social-icons').hide();
            $('#subscribe-little-box, #subscribe-box').hide();
        }
    });
});

// // Mouse Right Click Disable
// document.oncontextmenu = document.body.oncontextmenu = function() {return false;}
//
// // Disable F12 key and Ctrl+Shift+I combo
// document.addEventListener('keydown', event => {
//     if (event.keyCode === 123 || (event.ctrlKey && event.shiftKey && event.keyCode === 73)) {
//         event.preventDefault();
//     }
// });

// carousel
var copy = document.querySelector(".logos-slide").cloneNode(true);
document.querySelector(".logo-slider").appendChild(copy);

// Testimonials
(function ($) {
    "use strict";

    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

})(jQuery);


// Testimonials
(function ($) {
    "use strict";

    // Testimonials carousel
    $(".client-logo-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 2000,
        // center: true,
        margin: 24,
        dots: false,
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 3
            },
            768: {
                items: 4
            },
            992: {
                items: 6
            }
        }
    });

})(jQuery);


// Subscription Validation
$(document).ready(function () {
    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    $('#subscription-submit-disable').show();
    $('#subscription-submit-btn').hide();

    const validate = () => {
        const $result = $('#email-result');
        const email = $('#email').val();
        $result.text('');


        if (validateEmail(email)) {
            $result.text(email + ' is valid.');
            $result.css('color', 'green');
            $('#subscription-submit-disable').hide();
            $('#subscription-submit-btn').show();
        } else {
            $result.text(email + ' is invalid.');
            $result.css('color', 'red');
            $('#subscription-submit-disable').show();
            $('#subscription-submit-btn').hide();
        }
        return false;
    }

    $('#email').on('input', validate);
});

// Contact Form Validation

// Function to validate phone number
function validatePhoneNumber(input) {
    var phoneNumber = input.value.replace(/[^0-9+]/g, '');
    var regex = /^(\+?\d{1,3}[- ]?)?\d{11,13}$/; // Updated regex for a more flexible phone number validation
    var feedbackNumber = document.getElementById("feedbackNumber");

    if (!regex.test(phoneNumber)) {
        feedbackNumber.innerText = "Invalid phone number. Please enter a valid number only.";
        feedbackNumber.style.color = "red";
    } else {
        feedbackNumber.innerText = "Valid phone number!";
        feedbackNumber.style.color = "white";
    }
}

// Function to validate email
function validateEmail(input) {
    var email = input.value;
    var regex = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    var feedbackEmail = document.getElementById("feedbackEmail");

    if (!regex.test(email)) {
        feedbackEmail.innerText = "Invalid email. Please enter a valid email.";
        feedbackEmail.style.color = "red";
    } else {
        feedbackEmail.innerText = "Valid email!";
        feedbackEmail.style.color = "white";
    }
}

// Function to validate name
function validateName(input) {
    var name = input.value;
    // Assuming a valid name can contain letters and spaces
    var regex = /^[a-zA-Z\s]+$/;
    var feedbackName = document.getElementById("feedbackName");

    if (!regex.test(name)) {
        feedbackName.innerText = "Invalid name. Please enter a valid name.";
        feedbackName.style.color = "red";
    } else {
        feedbackName.innerText = "Valid name!";
        feedbackName.style.color = "white";
    }
}

// Function to validate designation
function validateDesignation(input) {
    var designation = input.value;
    // Assuming a valid designation can contain letters, numbers, and spaces
    var regex = /^[a-zA-Z0-9\s]+$/;
    var feedbackDesignation = document.getElementById("feedbackDesignation");

    if (!regex.test(designation)) {
        feedbackDesignation.innerText = "Invalid designation. Please enter a valid designation.";
        feedbackDesignation.style.color = "red";
    } else {
        feedbackDesignation.innerText = "Valid designation!";
        feedbackDesignation.style.color = "white";
    }
}


// Gallery

// JavaScript for gallery controls
document.addEventListener('DOMContentLoaded', function () {
    const galleryItems = document.querySelectorAll('[data-lightbox="gallery-item"]');
    const galleryControls = document.querySelector('.lightbox-controls');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const cancelButton = document.getElementById('cancelButton');
    let currentIndex = 0;

    // Hide gallery controls initially
    galleryControls.style.display = 'none';

    // Show gallery controls when any image is clicked
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', function () {
            galleryControls.style.display = 'flex';
            currentIndex = index;
        });
    });

    // Handle previous button click
    prevButton.addEventListener('click', function () {
        if (currentIndex > 0) {
            galleryItems[currentIndex].click();
            currentIndex--;
        }
    });

    // Handle next button click
    nextButton.addEventListener('click', function () {
        if (currentIndex < galleryItems.length - 1) {
            galleryItems[currentIndex].click();
            currentIndex++;
        }
    });

    // Handle cancel button click
    cancelButton.addEventListener('click', function () {
        galleryControls.style.display = 'none';
    });
});
