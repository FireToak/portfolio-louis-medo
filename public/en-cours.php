<?php
$noIndex = true; // On signale qu'on ne veut pas être indexé
include __DIR__ . '/../includes/header.php'; 
?>

<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-yellow-50 to-amber-50 px-4">
    <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12 max-w-2xl w-full text-center">
        <div class="mb-6">
            <svg class="w-24 h-24 mx-auto text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </div>
        
        <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Contenu en cours de rédaction</h1>
        
        <p class="text-base sm:text-lg text-gray-700 mb-6 leading-relaxed">
            Cette section est actuellement en cours de préparation. Le contenu sera bientôt disponible.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="index" class="bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition inline-flex items-center justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Retour à l'accueil
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>