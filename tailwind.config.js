/** @type {import('tailwindcss').Config} */
module.exports = {
  // Ci-dessous, on configure les chemins à surveiller
  content: [
    "./**/*.{php,js}",  // Cherche dans TOUS les sous-dossiers les fichiers .php et .js
    "!./node_modules/**" // (Sécurité) Exclut explicitement le dossier node_modules
  ],
  theme: {
    extend: {},
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1430px',  // Changé de 1024px à 1300px
      'xl': '1536px',
      '2xl': '1536px',
    },
  },
  plugins: [],
}
