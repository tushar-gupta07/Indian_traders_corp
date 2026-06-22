<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission & Vision - Indian Traders Corp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0a2463',
                        secondary: '#d32f2f',
                        accent: '#ff6b35',
                    }
                }
            }
        }
    </script>
    <style>
  

section.py-20, section.py-16, section.py-12,
section[class*="py-20"], section[class*="py-16"],
section[class*="py-28"], section[class*="py-24"] {
    padding-top: 40px !important;
    padding-bottom: 40px !important;
}

section .mb-16 { margin-bottom: 28px !important; }
section .mb-12 { margin-bottom: 20px !important; }
section .mt-12 { margin-top: 20px !important; }

@media (max-width: 767px) {
    section.py-20, section.py-16, section.py-12,
    section[class*="py-20"], section[class*="py-16"],
    section[class*="py-28"], section[class*="py-24"] {
        padding-top: 28px !important;
        padding-bottom: 28px !important;
    }
    section .mb-16 { margin-bottom: 20px !important; }
    section .mb-12 { margin-bottom: 16px !important; }
}
          .page-banner {
        height: 220px;
    }

  .banner-img {
    width: 100%;
    height: auto;          
    object-fit: fill;     
    display: block;
}

    @media (min-width: 640px) {
        .page-banner {
            height: 320px;
        }
        .banner-image {
            object-fit: cover;
        }
    }

    @media (min-width: 1024px) {
        .page-banner {
            height: 450px;
        }
    }

    @media (min-width: 1440px) {
        .page-banner {
            height: 550px;
        }
    }
        /* Lazy loading animation */
        .lazy-load {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .lazy-load.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Image lazy loading styles */
        img[data-src] {
            opacity: 0;
            transition: opacity 0.3s;
        }

        img.loaded {
            opacity: 1;
        }

        /* Skeleton loader for images */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
<?php include 'assets/include/header.php'; ?>

<!-- Include Modal -->
<?php include 'assets/include/modal.php'; ?>

<!-- Page Banner with Lazy Loading - WITH SKELETON -->
<section class="page-banner" style="width: 100%; position: relative; overflow: hidden; margin: 0; padding: 0; background: #e5e7eb;">
    <div style="position: relative; width: 100%; height: 100%;">
        <!-- Skeleton Loader -->
        <div class="skeleton banner-image" id="bannerSkeleton" style="width: 100%; height: 100%; display: block;"></div>
        <!-- Actual Image -->
        <img data-src="assets/images/crousel1.jpg" 
             alt="Mission & Vision - Indian Traders Corp" 
             class="banner-image"
             id="bannerImage"
             style="width: 100%; height: 100%; display: none; position: absolute; top: 0; left: 0;">
    </div>
</section>

<!-- Intro Section -->
<section class="py-20 bg-white lazy-load">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <div class="inline-block bg-blue-100 text-primary px-4 py-2 rounded-full text-sm font-bold mb-6">
                OUR PURPOSE
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-primary mb-6">Mission & Vision</h1>
            <p class="text-lg text-gray-700 leading-relaxed">
                At Indian Traders Corp, our mission and vision guide every decision we make. For over 55 years, we have been committed to providing exceptional industrial solutions while building lasting relationships with our clients across Central India.
            </p>
        </div>
    </div>
</section>

<!-- Mission & Vision Cards -->
<section class="py-20 bg-gradient-to-b from-gray-50 to-white lazy-load">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                <!-- Mission Card -->
                <div class="bg-gradient-to-br from-primary to-blue-900 p-10 rounded-2xl text-white shadow-2xl lazy-load">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold mb-6">Our Mission</h2>
                    <p class="text-blue-100 leading-relaxed text-lg mb-8">
                        To provide high-quality industrial valves, pipes, and fittings to our customers while maintaining competitive pricing and exceptional service standards. We strive to be the most trusted supplier in Central India through integrity, reliability, and a customer-first approach.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Quality First</h4>
                                <p class="text-blue-100 text-sm">Deliver genuine, ISO & ISI certified products with complete documentation</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Best Prices</h4>
                                <p class="text-blue-100 text-sm">Maintain competitive market rates without compromising on quality</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Customer Support</h4>
                                <p class="text-blue-100 text-sm">Ensure timely delivery, expert guidance, and exceptional service</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Card -->
                <div class="bg-gradient-to-br from-secondary to-red-800 p-10 rounded-2xl text-white shadow-2xl lazy-load">
                    <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold mb-6">Our Vision</h2>
                    <p class="text-red-100 leading-relaxed text-lg mb-8">
                        To become the leading authorized dealer and stockist for industrial supplies across India, recognized for our integrity, product quality, and customer-first approach. We aim to set industry standards for service excellence and reliability in everything we do.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">National Expansion</h4>
                                <p class="text-red-100 text-sm">Expand our reach across India as a trusted industrial partner</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Industry Leadership</h4>
                                <p class="text-red-100 text-sm">Set new benchmarks in quality, service, and customer satisfaction</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-white mb-1">Long-term Partnerships</h4>
                                <p class="text-red-100 text-sm">Build lasting relationships based on trust, integrity, and excellence</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-20 bg-white lazy-load">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <div class="inline-block bg-red-100 text-secondary px-4 py-2 rounded-full text-sm font-bold mb-4">
                    OUR FOUNDATION
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-primary mb-4">Core Values</h2>
                <p class="text-gray-600 text-lg">The principles that guide everything we do</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <div class="text-center bg-gray-50 p-8 rounded-xl lazy-load">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Integrity</h3>
                    <p class="text-gray-600 text-sm">Honest and transparent in all our business dealings</p>
                </div>

                <div class="text-center bg-gray-50 p-8 rounded-xl lazy-load">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Quality</h3>
                    <p class="text-gray-600 text-sm">Never compromise on product standards and certifications</p>
                </div>

                <div class="text-center bg-gray-50 p-8 rounded-xl lazy-load">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Customer First</h3>
                    <p class="text-gray-600 text-sm">Prioritize customer satisfaction in every interaction</p>
                </div>

                <div class="text-center bg-gray-50 p-8 rounded-xl lazy-load">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Excellence</h3>
                    <p class="text-gray-600 text-sm">Continuously improve and exceed expectations</p>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Commitment Section -->
<section class="py-20 bg-gradient-to-r from-primary to-blue-900 text-white lazy-load">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-6">Our Commitment to You</h2>
            <p class="text-xl text-blue-100 leading-relaxed mb-8">
                Since 1969, we have been committed to providing the highest quality industrial products and services. Our mission and vision are not just words—they are reflected in every product we supply, every service we provide, and every relationship we build.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lazy-load">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">55+</div>
                    <div class="text-blue-100">Years of Trust</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lazy-load">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">1000+</div>
                    <div class="text-blue-100">Happy Clients</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 lazy-load">
                    <div class="text-4xl font-bold text-yellow-400 mb-2">100%</div>
                    <div class="text-blue-100">Genuine Products</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-secondary to-red-800 text-white py-16 lazy-load">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Partner With a Company That Cares</h2>
        <p class="text-xl mb-8 text-red-100">Experience our commitment to quality and service excellence</p>
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="openQuoteModal()" class="bg-white text-secondary px-8 py-4 rounded-lg font-bold hover:bg-gray-100 transition-all transform hover:scale-105 shadow-lg">
                Get Quote Now
            </button>
            <a href="contact.php" class="bg-primary hover:bg-blue-900 text-white font-bold px-8 py-4 rounded-lg transition-all transform hover:scale-105 shadow-lg">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include 'assets/include/footer.php'; ?>

<script>
// ==========================================
// IMAGE LAZY LOADING - PRIORITY LOAD
// ==========================================

// Load banner image immediately on page load
window.addEventListener('DOMContentLoaded', function() {
    const bannerImg = document.getElementById('bannerImage');
    const bannerSkeleton = document.getElementById('bannerSkeleton');
    
    if (bannerImg && bannerImg.dataset.src) {
        // Load banner image immediately
        bannerImg.src = bannerImg.dataset.src;
        bannerImg.style.display = 'block';
        
        bannerImg.onload = function() {
            bannerImg.classList.add('loaded');
            if (bannerSkeleton) {
                bannerSkeleton.style.display = 'none';
            }
        };
        
        // Handle image load error
        bannerImg.onerror = function() {
            console.error('Banner image failed to load:', bannerImg.dataset.src);
            if (bannerSkeleton) {
                bannerSkeleton.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#666;">Image not found</div>';
            }
        };
    }
});

// ==========================================
// LAZY LOADING FOR SECTIONS
// ==========================================

const observerOptions = {
    root: null,
    rootMargin: '50px',
    threshold: 0.1
};

// Create observer for sections
const sectionObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('loaded');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all lazy-load sections
document.addEventListener('DOMContentLoaded', function() {
    const lazyElements = document.querySelectorAll('.lazy-load');
    lazyElements.forEach(el => {
        sectionObserver.observe(el);
    });
});

// ==========================================
// MODAL & FORM FUNCTIONS
// ==========================================

function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    if (menu) {
        menu.classList.toggle('hidden');
    }
}

function openQuoteModal() {
    openQuoteForm();
}

function closeQuoteModal() {
    closeQuoteForm();
}

function openQuoteForm() {
    const modal = document.getElementById('quoteModal');
    const content = document.getElementById('quoteModalContent');
    if (modal && content) {
        modal.classList.remove('hidden');
        setTimeout(function() {
            content.style.transform = 'scale(1)';
        }, 10);
        document.body.style.overflow = 'hidden';
    }
}

function closeQuoteForm() {
    const modal = document.getElementById('quoteModal');
    const content = document.getElementById('quoteModalContent');
    if (content) {
        content.style.transform = 'scale(0.95)';
        setTimeout(function() {
            if (modal) {
                modal.classList.add('hidden');
            }
        }, 300);
        document.body.style.overflow = '';
    }
}

function handleFormSubmit(event) {
    event.preventDefault();
    alert('Thank you! Your request has been submitted. We will contact you within 24 hours.');
    closeQuoteForm();
    const form = document.getElementById('quote-form');
    if (form) {
        form.reset();
    }
    return false;
}

// Close on background click
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('quoteModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target.id === 'quoteModal') {
                closeQuoteForm();
            }
        });
    }
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('quoteModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeQuoteForm();
        }
    }
});

// Console log for debugging
console.log('✓ Mission & Vision page loaded');
console.log('✓ Lazy loading initialized');
</script>
</body>
</html>
