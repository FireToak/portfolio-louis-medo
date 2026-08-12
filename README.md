# Portfolio BTS SIO - Louis MEDO

## Contexte

Ce projet est un portfolio personnel développé dans le cadre du BTS SIO, avec une volonté claire de sortir du format statique classique. Au lieu de recopier manuellement chaque information, les contenus sont centralisés dans des fichiers JSON puis injectés dynamiquement dans les vues PHP. Cette approche permet de maintenir le site plus proprement, de limiter les répétitions et d’illustrer une méthode de travail orientée produit et maintenabilité.

Le projet a également été pensé dans une logique de professionnalisation : conteneurisation avec Docker, configuration Apache adaptée, gestion des permissions, et préparation à un déploiement dans un environnement Kubernetes.

---

## Stack technique

- PHP 8.2
- Apache
- Tailwind CSS
- Docker / Docker Compose
- Fichiers JSON pour les données métiers
- Architecture orientée contenu et composants partagés

---

## Structure du dépôt

```bash
.
├── data/
│   ├── certifications.json
│   ├── competences.json
│   ├── experiences.json
│   ├── formations.json
│   ├── projets.json
│   └── veille.json
├── includes/
│   ├── footer.php
│   └── header.php
├── js/
│   └── script.js
├── public/
│   ├── assets/
│   ├── 404.php
│   ├── en-cours.php
│   ├── index.php
│   ├── robots.txt
│   └── sitemap.xml
├── apache-config.conf
├── Dockerfile
├── docker-compose.yaml
├── package.json
├── readme.md
├── tailwind.config.js
└── .gitignore
```

- `data/` : contient les informations du portfolio (formations, projets, compétences, expériences, veille, certifications).
- `includes/` : fichiers PHP réutilisés pour les éléments communs du site.
- `public/` : point d'entrée du site web, fichiers visibles côté navigateur.
- `js/` : script JavaScript personnalisé.
- `apache-config.conf` : configuration Apache pour servir le site sur le port 8080.
- `Dockerfile` et `docker-compose.yaml` : environnement de test et de conteneurisation.

---

## Prérequis

Avant de lancer le projet, il est nécessaire d’avoir :

- Git
- Docker et Docker Compose
- Node.js (si vous souhaitez reconstruire les assets Tailwind)

---

## Installation et utilisation

### 1. Cloner le dépôt

```bash
git clone https://github.com/FireToak/portfolio-louis-medo.git
cd portfolio-bts-sio
```

### 2. Installer les dépendances front

```bash
npm install
```

### 3. Générer le CSS Tailwind

```bash
npm run build
```

Pour un mode développement :

```bash
npm run dev
```

### 4. Tester le projet avec Docker

Construire l’image locale de test :

```bash
docker build -t dev-portfolio-louis-medo:1.0.8 .
```

Lancer le conteneur avec Docker Compose :

```bash
docker compose up -d
```

Le site est ensuite accessible à l’adresse suivante :

```text
http://localhost:8080
```

> Le conteneur expose le port 8080 afin de respecter une configuration de test simple et reproductible.

---

## Développement et workflow Git

### Créer une branche de travail

```bash
git checkout -b feat/description-fonctionnalite
```

Exemple de conventions :

- `feat/` pour une nouvelle fonctionnalité
- `fix/` pour une correction
- `hotfix/` pour une correction rapide
- `docs/` pour la documentation

### Valider et pousser les changements

```bash
git add .
git commit -m "feat: ajout de la section projets"
git push origin feat/description-fonctionnalite
```

### Ouvrir une pull request

1. Pousser la branche sur GitHub.
2. Ouvrir un pull request depuis le dépôt.
3. Vérifier les changements, demander une revue si nécessaire.
4. Fusionner dans la branche principale après validation.

### Ajouter un tag et publier une release

```bash
git tag -a v1.0.0 -m "Première version stable du portfolio"
git push origin --tags
```

Sur GitHub :

- aller dans l’onglet `Releases`
- cliquer sur `Draft a new release`
- choisir le tag créé
- renseigner un titre et une description claire
- publier la release

---

## Points forts du projet

- Dynamisation des contenus via des fichiers JSON
- Code plus maintenable et évolutif
- Structure logique et professionnelle
- Mise en œuvre d’un environnement Docker
- Conformité avec les bonnes pratiques de déploiement et de conteneurisation
- Capacité à démontrer une méthodologie de travail propre et rigoureuse

---

## Mainteneur

**Louis MEDO** | [LinkedIn](https://www.linkedin.com/in/louismedo/) | [Portfolio](https://louis.loutik.fr/) | [GitHub](https://github.com/FireToak) | [Email](mailto:louis.medo@loutik.fr)

---

<div align="center">
  <br/>
  <small><i>Dernière mise à jour : 12 août 2026</i></small>
</div>
