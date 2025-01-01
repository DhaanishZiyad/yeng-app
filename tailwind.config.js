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
                },
                'yeng-green': {
                    50: '#f2f9f4',
                    100: '#e5f4ea',
                    200: '#c4e4cb',
                    300: '#a0d2a9',
                    400: '#78bd84',
                    500: '#4bb579',
                    600: '#3c8e60',
                    700: '#2f6d4b',
                    800: '#214b33',
                    900: '#12261a',
                    950: '#09130d',
                },
                'yeng-gray': {
                    50: '#f9fafb',
                    100: '#f3f4f6',
                    200: '#e5e7eb',
                    300: '#d1d5db',
                    400: '#9ca3af',
                    500: '#6b7280',
                    600: '#4b5563',
                    700: '#374151',
                    800: '#1f2937',
                    900: '#111827',
                    950: '#0a0f16',
                },
            }
        },
    },

    plugins: [forms],
    darkMode: 'class', // Ensure dark mode is applied only when the class is present
};
