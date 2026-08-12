<?php
// Fonction pour charger et valider les données JSON
function loadJsonData($filename) {
    $filepath = __DIR__ . '/../data/' . $filename;
    
    if (!file_exists($filepath)) {
        error_log("Fichier JSON introuvable : $filepath");
        return [];
    }
    
    $json = file_get_contents($filepath);
    $data = json_decode($json, true);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Erreur JSON dans $filename : " . json_last_error_msg());
        return [];
    }
    
    return $data ?? [];
}

// Fonction pour échapper les données (protection XSS)
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Fonction pour autoriser certaines balises HTML (pour la veille)
function eHtml($string) {
    return strip_tags($string, '<span><strong><em><b><i>');
}

// Classes CSS centralisées pour cohérence
define('CSS_SECTION', 'flex items-center justify-center py-12 sm:py-16 md:py-20 lg:pb-32 px-4');
define('CSS_SECTION_BG_WHITE', CSS_SECTION . ' bg-white');
define('CSS_SECTION_BG_GRADIENT', CSS_SECTION . ' bg-gradient-to-br from-blue-50 to-cyan-50');
define('CSS_CONTAINER', 'container mx-auto max-w-4xl px-6');
define('CSS_TITLE', 'text-3xl sm:text-4xl font-bold text-center mb-8 sm:mb-12 section-title');
define('CSS_CARD', 'bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1');
define('CSS_CARD_GRADIENT', 'bg-blue-50 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1');
define('CSS_BTN_PRIMARY', 'inline-flex bg-teal-700 text-white px-4 py-3 rounded-lg hover:bg-teal-800 transition');
define('CSS_IMG_CONTAINER', 'flex justify-center md:justify-start bg-sky-50 overflow-hidden');
define('CSS_IMG', 'w-full h-32 sm:h-48 md:h-64 object-contain hover:scale-105 transition duration-300');

// Chargement des données
$experiences = loadJsonData('experiences.json');
$competences = loadJsonData('competences.json');
$formations = loadJsonData('formations.json');
$projets = loadJsonData('projets.json');
$certifications = loadJsonData('certifications.json');
$veilles = loadJsonData('veille.json');

// Filtrage des certifications par année
$certif_annee1 = array_filter($certifications, fn($c) => ($c['annee'] ?? 0) == 1);
$certif_annee2 = array_filter($certifications, fn($c) => ($c['annee'] ?? 0) == 2);

// Project category split (default: personnel)
$normalizeProjectCategory = fn($projet) => strtolower(trim($projet['categorie'] ?? 'personnel'));
$projets_bts = array_filter($projets, fn($p) => $normalizeProjectCategory($p) === 'bts');
$projets_personnels = array_filter($projets, fn($p) => $normalizeProjectCategory($p) === 'personnel');

include __DIR__ . '/../includes/header.php';
?>

    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-cyan-50 to-blue-50 pt-20 px-4">
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 md:p-12 max-w-2xl w-full text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4 section-title">Louis MEDO</h2>
            <p class="text-lg sm:text-xl text-gray-700 mb-6 sm:mb-8">Étudiant en BTS SIO SISR</p>
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <button data-scroll-to="presentation" class="scroll-btn bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition">Présentation</button>
                <button data-scroll-to="experiences" class="scroll-btn bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition">Expériences</button>
                <button data-scroll-to="projets" class="scroll-btn bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition">Projets</button>
            </div>
        </div>
    </section>

    <!-- À propos Section -->
    <section id="presentation" class="<?= CSS_SECTION_BG_WHITE ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">À propos</h2>
            <div class="<?= CSS_CARD_GRADIENT ?> rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
                <p class="text-base sm:text-lg mb-6 sm:mb-8 leading-relaxed">
                    Je m'appelle Louis, passionné et autodidacte dans le domaine de l'administration système. 
                    Actuellement, je prépare un BTS SIO (Services Informatiques aux Organisations) au lycée Paul Louis Courier.
                </p>
                <p class="text-base sm:text-lg mb-6 sm:mb-8 leading-relaxed">
                    Je consacre la majeure partie de mon temps libre à me tenir informé des nouvelles technologies et 
                    à pratiquer pour développer de nouvelles compétences. J'ai également transformé un ordinateur de 
                    bureau Z440 en serveur chez moi, sous VMware ESXi, où je gère différentes machines virtuelles sous 
                    Linux pour des services tels qu'OpenVPN, Docker, Nextcloud, Traefik et de l'hébergement web.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                    <a href="./assets/documents/medo-louis_cv.pdf" target="_blank" class="flex justify-center <?= $css_btn ?> mt-auto">
                        <button class="scroll-btn bg-teal-700 text-white px-6 py-3 rounded-lg hover:bg-teal-800 transition">Curriculum vitæ
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Formation Section -->
    <section id="formation" class="<?= CSS_SECTION_BG_GRADIENT ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">Formation</h2>
            
            <div class="<?= CSS_CARD ?> rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
                <div class="relative">
                    <div class="absolute left-4 sm:left-8 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-500 to-blue-300"></div>

                    <div class="space-y-8 sm:space-y-12">
                        <?php if (empty($formations)): ?>
                            <p class="text-center text-gray-600 ml-16 sm:ml-24">Aucune formation disponible.</p>
                        <?php else: ?>
                            <?php foreach ($formations as $formation): ?>
                                <div class="flex gap-4 sm:gap-6 ml-16 sm:ml-24">
                                    <div class="absolute left-0 sm:left-2 w-8 sm:w-12 h-8 sm:h-12 bg-blue-500 rounded-full border-4 border-white shadow-lg"></div>

                                    <div class="pt-1 sm:pt-2 flex-1">
                                        <h3 class="text-xl sm:text-2xl font-bold text-blue-600 mb-1 sm:line-clamp-2">
                                            <?= e($formation['diplome'] ?? '') ?>
                                        </h3>
                                        <p class="text-base sm:text-lg font-semibold text-gray-800 mb-1 sm:line-clamp-1">
                                            <?= e($formation['ecole'] ?? '') ?>
                                        </p>
                                        <p class="text-sm sm:text-base font-semibold text-gray-600 mb-3 sm:line-clamp-1">
                                            <?= e($formation['annee'] ?? '') ?>
                                        </p>
                                        <p class="text-sm sm:text-base text-gray-700 sm:line-clamp-3">
                                            <?= e($formation['description'] ?? '') ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BTS SIO Section -->
    <section id="bts-sio" class="<?= CSS_SECTION_BG_WHITE ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">BTS SIO</h2>
            <div class="<?= CSS_CARD_GRADIENT ?> rounded-2xl shadow-xl p-6 sm:p-8 md:p-10">
                <p class="text-base sm:text-lg text-gray-700 mb-6 sm:mb-8 leading-relaxed">
                    Le BTS Services Informatiques aux Organisations est une formation en deux ans qui prépare aux 
                    métiers de l'informatique. Il propose deux spécialités distinctes, adaptées aux différents profils 
                    et aspirations professionnelles.
                </p>
                
                <h3 class="text-xl sm:text-2xl font-semibold text-blue-600 mb-4 sm:mb-6">Objectifs du BTS :</h3>
                
                <ul class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-700 mb-6 sm:mb-8">
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-3 mt-1 shrink-0">•</span>
                        <span>Former des professionnels polyvalents en informatique, capables d'intervenir sur les 
                        infrastructures, les réseaux, et les systèmes d'information.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-3 mt-1 shrink-0">•</span>
                        <span>Développer des compétences techniques en programmation, administration système, 
                        cybersécurité, et gestion de bases de données.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-3 mt-1 shrink-0">•</span>
                        <span>Préparer à la gestion de projets informatiques en intégrant des méthodes agiles et 
                        des bonnes pratiques de travail collaboratif.</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-blue-600 mr-3 mt-1 shrink-0">•</span>
                        <span>Faciliter l'insertion professionnelle ou la poursuite d'études (licences, écoles 
                        d'ingénieurs) grâce à une formation équilibrée entre théorie et pratique (stages, projets concrets).</span>
                    </li>
                </ul>
                <!-- Options BTS SIO -->
                <h3 class="text-xl sm:text-2xl font-semibold text-blue-600 mb-4 sm:mb-6">Les deux spécialités :</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    <!-- Option SISR -->
                    <div class="<?= CSS_CARD ?> bg-gray border border-gray-100 rounded-xl p-6 hover:shadow-xl">
                        <h4 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                            <span class="text-blue-600 mr-2">⚙️</span> SISR
                        </h4>
                        <p class="text-sm text-gray-600 mb-3">
                            Solutions d'Infrastructure, Systèmes et Réseaux.
                        </p>
                        <p class="text-sm text-gray-700">
                            Conception, déploiement et maintenance des infrastructures réseaux et serveurs. Focus sur l'administration système, la virtualisation et la cybersécurité.
                        </p>
                    </div>

                    <!-- Option SLAM -->
                    <div class="<?= CSS_CARD ?> bg-gray-50 border border-gray-100 rounded-xl p-6 hover:shadow-xl">
                        <h4 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                            <span class="text-blue-600 mr-2">💻</span> SLAM
                        </h4>
                        <p class="text-sm text-gray-600 mb-3">
                            Solutions Logicielles et Applications Métiers.
                        </p>
                        <p class="text-sm text-gray-700">
                            Conception et développement d'applications (web, mobiles, lourdes). Focus sur le code, les bases de données et la gestion de projet logiciel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expériences Section -->
    <section id="experiences" class="<?= CSS_SECTION_BG_GRADIENT ?>">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-4xl font-bold text-center mb-12 section-title">Expériences</h2>
            <div class="space-y-6">
                <?php if (empty($experiences)): ?>
                    <p class="text-center text-gray-600">Aucune expérience disponible.</p>
                <?php else: ?>
                    <?php foreach ($experiences as $exp): ?>
                        <div class="<?= CSS_CARD ?> p-8">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                                <p class="text-sm bg-blue-300 text-gray-800 px-2 py-2 rounded-2xl inline-block max-w-xs mb-2 sm:mb-0 sm:ml-3 order-1 sm:order-2">
                                    <?= e($exp['type'] ?? '') ?> - <?= e($exp['date'] ?? '') ?>
                                </p>
                                <h3 class="text-2xl font-semibold text-gray-800 mb-0 order-2 sm:order-1">
                                    <?= e($exp['poste'] ?? '') ?>
                                </h3>
                            </div>
                            <p class="text-gray-600 mb-4"><?= e($exp['entreprise'] ?? '') ?></p>
                            <p class="text-gray-700 mb-8 sm:line-clamp-4"><?= e($exp['description'] ?? '') ?></p>
                            <?php if (!empty($exp['lien_rapport'])): ?>
                                <a href="<?= e($exp['lien_rapport']) ?>" target="_blank" rel="noopener noreferrer" class="<?= CSS_BTN_PRIMARY ?>">Rapport de stage</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Compétences Section -->
    <section id="competences" class="<?= CSS_SECTION_BG_WHITE ?>">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-4xl font-bold text-center mb-12 section-title">Compétences</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if (empty($competences)): ?>
                    <p class="col-span-full text-center text-gray-600">Aucune compétence disponible.</p>
                <?php else: ?>
                    <?php foreach ($competences as $cat): ?>
                        <div class="<?= CSS_CARD ?> p-6 duration-300 flex flex-col h-full">
                            <h3 class="text-xl font-semibold text-gray-800 mb-6 pb-2 border-b-2 border-gray-800">
                                <?= e($cat['category'] ?? '') ?>
                            </h3>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <?php foreach ($cat['skills'] ?? [] as $skill): ?>
                                    <div class="flex flex-col items-center justify-center p-3 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors duration-200 group">
                                        <i class="<?= e($skill['icon'] ?? '') ?> text-3xl mb-2 group-hover:scale-110 transition-transform duration-200"></i>
                                        <span class="text-sm font-medium text-gray-600 text-center"><?= e($skill['name'] ?? '') ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Projets Section -->
    <section id="projets" class="<?= CSS_SECTION_BG_GRADIENT ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">Projets</h2>

            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-lg bg-gray-100 p-1">
                    <button type="button" data-project-category="bts" class="project-btn px-4 py-2 rounded-l-lg text-sm font-medium bg-white  hover:bg-white transition">
                        BTS SIO
                    </button>
                    <button type="button" data-project-category="personnel" class="project-btn px-4 py-2 rounded-r-lg text-sm font-medium text-gray-700 hover:bg-white transition">
                        Projets personnels
                    </button>
                </div>
            </div>

            <?php
            function renderProjectCard($projet) {
                $isBtsProject = strtolower(trim($projet['categorie'] ?? 'personnel')) === 'bts';
                $tags = $projet['tags'] ?? [];
                ?>
                <div class="<?= CSS_CARD ?> flex flex-col h-full">
                    <div class="<?= CSS_IMG_CONTAINER ?>">
                        <img src="<?= e($projet['image'] ?? '') ?>"
                             alt="<?= e($projet['titre'] ?? '') ?>"
                             class="<?= CSS_IMG ?>"
                             loading="lazy">
                    </div>

                    <div class="p-4 sm:p-6 flex flex-col flex-grow">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 pb-2 border-b-2 border-gray-800 line-clamp-2">
                            <?= e($projet['titre'] ?? '') ?>
                        </h3>

                        <?php if (!$isBtsProject && !empty($tags)): ?>
                            <div class="flex flex-wrap gap-2 mb-3">
                                <?php foreach ($tags as $tag): ?>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                        <?= e($tag) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <p class="text-sm sm:text-base text-gray-700 leading-relaxed mb-4 <?= $isBtsProject ? '' : 'flex-grow line-clamp-4' ?>">
                            <?= e($projet['description'] ?? '') ?>
                        </p>

                        <?php if ($isBtsProject && !empty($tags)): ?>
                            <div class="mb-4">
                                <h4 class="text-sm sm:text-base font-semibold text-gray-800 mb-2">Compétences mobilisées</h4>
                                <ul class="project-skills-list space-y-1 text-sm sm:text-base text-gray-700">
                                    <?php foreach ($tags as $tag): ?>
                                        <li><?= e($tag) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($projet['lien'])): ?>
                            <a href="<?= e($projet['lien']) ?>" target="_blank" rel="noopener noreferrer" class="flex justify-center <?= CSS_BTN_PRIMARY ?> mt-auto">
                                <p>Voir le projet</p>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <div id="projets-category-bts" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <?php if (empty($projets_bts)): ?>
                    <p class="col-span-full text-center text-gray-600">Aucun projet BTS SIO disponible pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($projets_bts as $projet): ?>
                        <?php renderProjectCard($projet); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div id="projets-category-personnel" class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 hidden">
                <?php if (empty($projets_personnels)): ?>
                    <p class="col-span-full text-center text-gray-600">Aucun projet personnel disponible pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($projets_personnels as $projet): ?>
                        <?php renderProjectCard($projet); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section id="certifications" class="<?= CSS_SECTION_BG_WHITE ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">Certifications</h2>

            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-lg bg-gray-100 p-1">
                    <button type="button" data-year="1" class="year-btn px-4 py-2 rounded-l-lg text-sm font-medium text-gray-700 hover:bg-white transition">
                        Lycée SN RISC
                    </button>
                    <button type="button" data-year="2" class="year-btn px-4 py-2 rounded-r-lg text-sm font-medium text-gray-700 hover:bg-white transition">
                        BTS SIO 1ère année
                    </button>
                </div>
            </div>

            <?php
            // Template de carte de certification
            function renderCertificationCard($certif) {
                $css_card = CSS_CARD_GRADIENT;
                $css_img_container = CSS_IMG_CONTAINER;
                $css_img = CSS_IMG;
                $css_btn = CSS_BTN_PRIMARY;
                ?>
                <div class="<?= $css_card ?> flex flex-col h-full">
                    <div class="<?= $css_img_container ?>">
                        <img src="<?= e($certif['image'] ?? '') ?>" 
                             alt="<?= e($certif['titre'] ?? '') ?>" 
                             class="<?= $css_img ?>"
                             loading="lazy">
                    </div>
                    <div class="p-6 sm:p-8 text-center flex flex-col flex-grow">
                        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                            <?= e($certif['titre'] ?? '') ?>
                        </h3>
                        
                        <div class="mb-4">
                            <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold line-clamp-1">
                                <?= e($certif['date'] ?? '') ?>
                            </span>
                        </div>
                        
                        <p class="text-sm sm:text-base text-gray-700 mb-3 pb-3 flex-grow line-clamp-3">
                            <?= e($certif['description'] ?? '') ?>
                        </p>
                        
                        <?php if (!empty($certif['lien'])): ?>
                            <a href="<?= e($certif['lien']) ?>" target="_blank" rel="noopener noreferrer" class="flex justify-center <?= $css_btn ?> mt-auto">
                                Voir le certificat
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            }
            ?>

            <div id="certifications-year-1" class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                <?php if (empty($certif_annee1)): ?>
                    <p class="col-span-full text-center text-gray-600">Aucune certification disponible pour cette période.</p>
                <?php else: ?>
                    <?php foreach ($certif_annee1 as $certif): ?>
                        <?php renderCertificationCard($certif); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div id="certifications-year-2" class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 hidden">
                <?php if (empty($certif_annee2)): ?>
                    <p class="col-span-full text-center text-gray-600">Aucune certification disponible pour cette période.</p>
                <?php else: ?>
                    <?php foreach ($certif_annee2 as $certif): ?>
                        <?php renderCertificationCard($certif); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Veille Technologique Section -->
    <section id="veille" class="<?= CSS_SECTION_BG_GRADIENT ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">Veille technologique</h2>

            <div class="flex flex-col items-center gap-6 sm:gap-8 max-w-2xl mx-auto">
            
                <h3 class="italic text-lg font-semibold text-gray-700 mb-4">L'Intelligence Artificielle dans les opérations d'infrastructures</h3>

                <div class="w-full <?= CSS_CARD ?> p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center justify-center">
                        <span class="text-blue-600 mr-2">📥</span> 1. Sources d'information
                    </h3>
                    <div class="flex flex-wrap justify-center gap-3">
                        <?php foreach ($veilles as $source): ?>
                            <a href="<?= e($source['lien'] ?? '') ?>" target="_blank" rel="noopener noreferrer" class="border border-gray-200 px-4 py-2 rounded-lg shadow-sm text-sm font-medium bg-gray-100 hover:bg-blue-50 transition">
                                    <?= e($source['titre'] ?? '') ?> 
                                    <?php if (!empty($source['type'])): ?>
                                        <span class="text-xs text-gray-500">(<?= e($source['type']) ?>)</span>
                                    <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="flex justify-center text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </div>

                <div class="w-full <?= CSS_CARD ?> p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2 flex items-center justify-center">
                        <span class="text-amber-500 mr-2">📡</span> 2. Extraction & agrégation
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base">
                        Récupération centralisée des flux RSS des sources listées.
                    </p>
                </div>

                <div class="flex justify-center text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </div>

                <div class="w-full <?= CSS_CARD ?> p-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center justify-center">
                        <span class="text-teal-700 mr-2">⚙️</span> 3. Traitement N8N & publication
                    </h3>
                    <p class="text-gray-700 text-sm sm:text-base mb-6 leading-relaxed">
                        Les données brutes sont récupérées puis synthétisées par une intelligence artificielle via un workflow d'automatisation N8N. Le résultat est publié automatiquement.
                    </p>
                    
                    <a href="https://digest.loutik.fr" target="_blank" rel="noopener noreferrer" class="<?= CSS_BTN_PRIMARY ?>">
                        Voir mes synthèses
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- Épreuves Section -->
    <section id="Épreuves" class="<?= CSS_SECTION_BG_WHITE ?>">
        <div class="<?= CSS_CONTAINER ?>">
            <h2 class="<?= CSS_TITLE ?>">Épreuves</h2>

            <div class="flex justify-center mb-8">
                <div class="inline-flex rounded-lg bg-gray-100 p-1">
                    <button type="button" data-epreuve="5" class="epreuves-btn px-4 py-2 rounded-l-lg text-sm font-medium text-gray-700 hover:bg-white transition">
                        Épreuve E5
                    </button>
                    <button type="button" data-epreuve="6" class="epreuves-btn px-4 py-2 rounded-r-lg text-sm font-medium text-gray-700 hover:bg-white transition">
                        Épreuve E6
                    </button>
                </div>
            </div>

            <!-- Épreuve E5 -->
            <div id="epreuve-5" class="grid grid-cols-1 gap-6 sm:gap-8">
                <div class="<?= CSS_CARD_GRADIENT ?> p-6 sm:p-8">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3">Présentation de l'épreuve E5 (SISR)</h3>
                    <p class="text-sm sm:text-base text-gray-700 mb-3 pb-3">
                        L'épreuve E5, intitulée « Administration des systèmes et des réseaux », est une épreuve orale de soutenance et d'échange qui porte sur le parcours de professionnalisation de l'étudiant dans le cadre de l'option SISR (Solutions d'Infrastructure, Systèmes et Réseaux).
                    </p>

                    <div class="bg-white rounded-lg p-4 ring-2 ring-inset ring-gray-200">
                        <h4 class="lg:text-xl sm:text-2xl font-semibold text-blue-600 mb-4 sm:mb-6">Attendu de l'épreuve :</h4>
                        <ul class="space-y-3 sm:space-y-4 text-sm sm:text-base text-gray-700">
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Gérer le patrimoine informatique.</span></li>
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Répondre aux incidents et aux demandes d'assistance et d'évolution.</span></li>
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Développer la présence en ligne de l'organisation.</span></li>
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Travailler en mode projet.</span></li>
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Mettre à disposition des utilisateurs un service informatique.</span></li>
                            <li class="flex items-start"><span class="text-blue-600 mr-3 mt-1 flex-shrink-0">•</span><span>Organiser son développement professionnel.</span></li>
                        </ul>
                    </div>

                    <a href="assets/documents/referentiel_epreuve-E5.pdf" target="_blank" rel="noopener noreferrer" class="<?= CSS_BTN_PRIMARY ?> mt-5">
                        Référentiel de l'épreuve E5
                    </a>
                </div>

                <div class="<?= CSS_CARD_GRADIENT ?> p-6 sm:p-8">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3">Tableau de synthèse épreuve E5 (SISR)</h3>
                    <p class="text-sm sm:text-base text-gray-700 mb-3 pb-2">
                        Le tableau de synthèse est un document obligatoire qui récapitule l'ensemble des réalisations professionnelles effectuées par l'étudiant durant sa formation (stages, projets, TP significatifs, etc.).
                    </p>

                    <a href="https://kdrive.infomaniak.com/app/share/831857/3159b7dc-b846-44df-82e4-de35cf855be0" target="_blank" rel="noopener noreferrer" class="<?= CSS_BTN_PRIMARY ?>">
                        Visualisez le tableau de synthèse
                    </a>
                </div>
            </div>

            <!-- Épreuve E6 -->
            <div id="epreuve-6" class="grid grid-cols-1 gap-6 sm:gap-8 hidden">
                <div class="<?= CSS_CARD_GRADIENT ?> p-6 sm:p-8">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3">Présentation de l'épreuve E6 (SISR)</h3>
                    <p class="text-sm sm:text-base text-gray-700 mb-3 pb-3">
                        L'épreuve E6, intitulée « Parcours de professionnalisation », vise à évaluer la capacité du candidat à mobiliser ses compétences techniques et professionnelles acquises tout au long de la formation en Solutions d'Infrastructure, Systèmes et Réseaux (SISR).
                    </p>
                </div>
            </div>
        </div>
    </section>

<?php include __DIR__ . '/../includes/footer.php'; ?>