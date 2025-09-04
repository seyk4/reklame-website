/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {},
    },

    plugins: [],
};