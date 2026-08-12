<?php
$noIndex = true; // On signale qu'on ne veut pas être indexé
include __DIR__ . '/../includes/header.php'; 
?>

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-red-50 to-orange-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12 max-w-2xl w-full text-center">
        <div class="mb-6">
            <svg class="w-24 h-24 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        
        <h1 class="text-6xl sm:text-8xl font-bold text-red-500 mb-4">404</h1>
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Page non trouvée</h2>
        
        <p class="text-base sm:text-lg text-gray-700 mb-8 leading-relaxed">
            Désolé, la page que vous recherchez est introuvable. Elle a peut-être été déplacée ou supprimée.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="index" class="bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Retour à l'accueil
            </a>
            <button onclick="history.back()" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Page précédente
            </button>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>