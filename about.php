<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Indian Traders Corp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0a2463',
                        secondary: '#b71c1c',
                        accent: '#ff6b35',
                    }
                }
            }
        }
    </script>
    <style>
        .page-banner { height: 220px; }
        .banner-image { object-fit: contain; object-position: center; }
        @media (min-width: 640px) {
            .page-banner { height: 320px; }
            .banner-image { object-fit: cover; }
        }
        @media (min-width: 1024px) {
            .page-banner { height: 450px; }
            .banner-image { object-fit: cover; }
        }
        @media (min-width: 1440px) {
            .page-banner { height: 550px; }
        }
    </style>
</head>
<body class="bg-gray-50">
<?php include 'assets/include/header.php'; ?>
<?php include 'assets/include/modal.php'; ?>

<!-- Banner -->
<section class="page-banner" style="width:100%;position:relative;overflow:hidden;margin:0;padding:0;background:#e5e7eb;">
    <div style="position:relative;width:100%;height:100%;">
        <img src="./assets/images/crousel1.jpg" alt="About Indian Traders Corp" class="banner-image" style="width:100%;height:100%;display:block;">
    </div>
</section>

<!-- Company Overview -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <div class="inline-block bg-blue-100 text-primary px-4 py-1 rounded-full text-sm font-bold mb-3">
                        OUR STORY
                    </div>
                    <h2 class="text-3xl font-bold text-primary mb-4">Trusted Name in Industrial Supplies</h2>
                    <p class="text-base text-gray-700 leading-relaxed mb-3">
                        Established in 1969, Indian Traders Corp has been a cornerstone in the industrial supplies sector for over five decades. We serve as authorized stockists and dealers for industrial valves, pipes, fittings, and accessories throughout Central India.
                    </p>
                    <p class="text-base text-gray-700 leading-relaxed">
                        Based in Nagpur, Maharashtra, we have built our reputation on quality products, competitive pricing, and exceptional customer service. Our partnership-based business model allows us to maintain strong relationships with both suppliers and customers.
                    </p>
                </div>
                <div class="relative">
                    <div class="bg-gradient-to-br from-primary to-blue-900 rounded-2xl p-6 text-white shadow-2xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-yellow-400 mb-1">55+</div>
                                <div class="text-sm text-blue-200">Years in Business</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-yellow-400 mb-1">500+</div>
                                <div class="text-sm text-blue-200">Products</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-yellow-400 mb-1">1000+</div>
                                <div class="text-sm text-blue-200">Happy Clients</div>
                            </div>
                            <div class="text-center">
                                <div class="text-4xl font-bold text-yellow-400 mb-1">₹25Cr</div>
                                <div class="text-sm text-blue-200">Annual Turnover</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Leadership Team -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <div class="inline-block bg-red-100 text-secondary px-4 py-1 rounded-full text-sm font-bold mb-3">
                LEADERSHIP
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Meet Our Team</h2>
            <p class="text-gray-600 text-base">Experienced professionals driving our success</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 max-w-6xl mx-auto">
            <div class="text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-white">BG</span>
                </div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Bharatchandra Gupta</h3>
                <p class="text-secondary font-semibold text-sm">Partner</p>
            </div>
            <div class="text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="w-24 h-24 bg-gradient-to-br from-red-600 to-red-800 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-white">SG</span>
                </div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Sharadchandra Gupta</h3>
                <p class="text-secondary font-semibold text-sm">Partner</p>
            </div>
            <div class="text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="w-24 h-24 bg-gradient-to-br from-green-600 to-green-800 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-white">SG</span>
                </div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Satishchandra Gupta</h3>
                <p class="text-secondary font-semibold text-sm">Partner</p>
            </div>
            <div class="text-center bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-600 to-purple-800 rounded-full mx-auto mb-4 flex items-center justify-center shadow-lg">
                    <span class="text-3xl font-bold text-white">HG</span>
                </div>
                <h3 class="text-base font-bold text-gray-800 mb-1">Hitesh Gandecha</h3>
                <p class="text-secondary font-semibold text-sm">CEO</p>
            </div>
        </div>
    </div>
</section>

<!-- Certifications -->
<section class="py-8 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <div class="inline-block bg-red-100 text-secondary px-4 py-1 rounded-full text-sm font-bold mb-3">
                QUALITY ASSURANCE
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-2">Certifications & Standards</h2>
            <p class="text-gray-600 text-base">Internationally recognized quality certifications</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            <div class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-200 p-6 rounded-2xl text-center shadow-lg hover:shadow-xl transition">
                <div class="w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-primary mb-1">ISO 9001:2008</h3>
                <p class="text-gray-600 text-sm">Quality Management System Certified</p>
            </div>
            <div class="bg-gradient-to-br from-green-50 to-white border-2 border-green-200 p-6 rounded-2xl text-center shadow-lg hover:shadow-xl transition">
                <div class="w-20 h-20 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-green-700 mb-1">ISI Certified</h3>
                <p class="text-gray-600 text-sm">Indian Standards Institute Approved</p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-white border-2 border-red-200 p-6 rounded-2xl text-center shadow-lg hover:shadow-xl transition">
                <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-secondary mb-1">ASTM, IBR, JIS</h3>
                <p class="text-gray-600 text-sm">International Grade Materials</p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-8 bg-gradient-to-b from-gray-50 to-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 rounded-2xl text-white shadow-2xl">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Our Mission</h3>
                <p class="text-blue-100 leading-relaxed text-base">
                    To provide high-quality industrial valves, pipes, and fittings to our customers while maintaining competitive pricing and exceptional service standards. We strive to be the most trusted supplier in Central India through integrity, reliability, and customer-first approach.
                </p>
            </div>
            <div class="bg-gradient-to-br from-red-600 to-red-800 p-8 rounded-2xl text-white shadow-2xl">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-3">Our Vision</h3>
                <p class="text-red-100 leading-relaxed text-base">
                    To become the leading authorized dealer and stockist for industrial supplies across India, known for our integrity, product quality, and customer-first approach. We aim to set industry standards for service excellence and reliability in everything we do.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-gradient-to-r from-primary via-blue-900 to-blue-800 text-white py-10">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-3">Partner With Us Today</h2>
        <p class="text-lg mb-6 text-blue-100">Experience the difference of working with industry leaders</p>
        <div class="flex flex-wrap justify-center gap-4">
            <button onclick="openQuoteModal()" class="bg-gradient-to-r from-secondary to-red-700 text-white px-8 py-3 rounded-lg font-bold hover:from-red-700 hover:to-secondary transition-all transform hover:scale-105 shadow-lg">
                Get Quote
            </button>
            <a href="contact.php" class="bg-white hover:bg-gray-100 text-primary font-bold px-8 py-3 rounded-lg transition transform hover:scale-105 shadow-xl">
                Contact Us
            </a>
        </div>
    </div>
</section>

<?php include 'assets/include/footer.php'; ?>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
}
function openQuoteModal() { openQuoteForm(); }
function closeQuoteModal() { closeQuoteForm(); }
function openQuoteForm() {
    const modal = document.getElementById('quoteModal');
    const content = document.getElementById('quoteModalContent');
    modal.classList.remove('hidden');
    setTimeout(function() { content.style.transform = 'scale(1)'; }, 10);
    document.body.style.overflow = 'hidden';
}
function closeQuoteForm() {
    const content = document.getElementById('quoteModalContent');
    content.style.transform = 'scale(0.95)';
    setTimeout(function() { document.getElementById('quoteModal').classList.add('hidden'); }, 300);
    document.body.style.overflow = '';
}
function handleFormSubmit(event) {
    event.preventDefault();
    alert('Thank you! Your quote request has been submitted. We will contact you within 24 hours.');
    closeQuoteForm();
    document.getElementById('quote-form').reset();
    return false;
}
document.getElementById('quoteModal')?.addEventListener('click', function(e) {
    if (e.target.id === 'quoteModal') { closeQuoteForm(); }
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('quoteModal');
        if (modal && !modal.classList.contains('hidden')) { closeQuoteForm(); }
    }
});
</script>
</body>
</html>