import defaultTheme from 'tailwindcss/defaultTheme';
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
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
                display: ['"Playfair Display"', 'Georgia', 'serif'],
            },
            colors: {
                wine: {
                    DEFAULT: '#a20e49',
                    dark: '#85142d',
                    deep: '#75172b',
                },
                rose: {
                    DEFAULT: '#fff5f7',
                    card: '#ffedf1',
                    soft: '#fce3e9',
                },
                ink: '#56142a',
                muted: '#806873',
                gold: '#f6a600',
            },
        },
    },

    plugins: [forms],
};
