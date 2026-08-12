<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Louis MEDO - Portfolio - BTS SIO</title>
    <meta name="description" content="Portfolio de Louis MEDO, étudiant en BTS SIO option SISR. Découvrez mes projets en administration système, cloud et cybersécurité.">
    <meta name="author" content="Louis MEDO">

    <!-- Styles -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">   
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon/android-chrome-192x192.png">
    <link rel="manifest" href="assets/img/favicon/site.webmanifest">   
    <!-- Scripts -->
     <script src="assets/js/script.js" defer></script>
    <!-- Balise no-index -->
    <?php if (isset($noIndex) && $noIndex === true): ?>
        <meta name="robots" content="noindex, nofollow">
    <?php endif; ?>
    <!-- Embeds -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://louis.loutik.fr/">
    <meta property="og:title" content="Louis MEDO - Portfolio">
    <meta property="og:description" content="Étudiant en BTS SIO. Découvrez mes projets sur Kubernetes, Proxmox et GitLab.">
    <meta property="og:image" content="https://louis.loutik.fr/assets/img/photo-louis-medo.png">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Louis MEDO - Portfolio">
    <meta property="twitter:description" content="Découvrez mon parcours et mes projets IT.">
    <meta property="twitter:image" content="https://louis.loutik.fr/assets/img/photo-louis-medo.png">
</head>

<body class="overflow-x-hidden">
    <!-- Mobile Header (visible only on mobile) -->
    <header class="lg:hidden fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-end px-4 py-3">
            <button id="mobile-menu-btn" class="text-gray-700 hover:text-blue-600 transition p-2 bg-white rounded-lg shadow-md">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <nav id="sidebar-nav" class="fixed top-1/2 left-0 lg:left-4 -translate-y-1/2 w-64 bg-white/70 backdrop-blur-md rounded-2xl shadow-xl z-40 
                                transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out
                                overflow-hidden flex flex-col max-h-[90vh]">
        
        <!-- Logo/Title -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-bold text-gray-800">Portfolio</h2>
            <p class="text-sm text-gray-600 mt-1">Louis\MEDO</p>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1 px-3">
                <li>
                    <button data-scroll-to="presentation" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            À propos
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="bts-sio" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            BTS SIO
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="experiences" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Expériences
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="competences" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                            Compétences
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="formation" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                            Formation
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="projets" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                            </svg>
                            Projets
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="certifications" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Certifications
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="veille" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Veille Technologique
                        </span>
                    </button>
                </li>
                <li>
                    <button data-scroll-to="Épreuves" class="nav-link w-full text-left px-4 py-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Épreuves
                        </span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- CTA Button -->
        <div class="p-4 border-t border-gray-200">
            <a href="mailto:louismedo.pro@gmail.com" class="flex items-center justify-center w-full bg-teal-700 text-white px-4 py-3 rounded-lg hover:bg-teal-800 transition-colors duration-200 font-medium text-sm shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Contact
            </a>
        </div>
    </nav>

    <!-- Overlay for mobile menu -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>

    <!-- Main content wrapper WITHOUT padding, padding will be on containers -->
    <main class="lg:pt-0">