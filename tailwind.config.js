import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', 'system-ui', 'sans-serif'],
                heading: ['Bebas Neue', 'sans-serif'],
            },
            colors: {
                dark: '#111827',
                'neutral-dark': '#1F2937',
                light: '#E5E7EB',
                gray: '#94A3B8',
            },
        },
    },

    plugins: [forms],
};
