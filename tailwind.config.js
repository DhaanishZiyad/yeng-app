import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', 'sans-serif'],
                raleway: ['Raleway', 'sans-serif'],

            },
            colors: {
                'yeng-pink': {
                  50: '#fef2f0',
                  100: '#fee9e7',
                  200: '#fdd2ce',
                  300: '#fbb7b1',
                  400: '#faa199',
                  500: '#f98b80',
                  600: '#f64737',
                  700: '#d61b0a',
                  800: '#921207',
                  900: '#490903',
                  950: '#220402',
                }
            }
        },
    },

    plugins: [forms],
    darkMode: 'class', // Ensure dark mode is applied only when the class is present
};
