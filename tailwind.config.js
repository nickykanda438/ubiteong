import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    // Définition des fichiers à scanner pour extraire les classes CSS
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            // 1. CONFIGURATION DE LA PALETTE DE COULEURS (CHARTE KAZWAZWA)
            colors: {
                'kzz-blue': '#003366',    // Bleu Institutionnel (Blocs et sécurité)
                'kzz-green': '#28A745',   // Vert Espoir (Badges et succès)
                'kzz-gray': '#F8F9FA',    // Gris de Fond (Bordures et fonds légers)
                'kzz-black': '#212529',   // Noir Anthracite (Textes dynamiques)
            },

            fontFamily: {
                sans: ['Roboto', 'Helvetica', 'Arial', ...defaultTheme.fontFamily.sans],
                title: ['Montserrat', 'Roboto', 'sans-serif'],
            },
        },
    },
    plugins: [forms],
};