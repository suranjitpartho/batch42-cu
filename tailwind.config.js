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
            colors: {
                'primary': '#3c997d',
                'primary-dark': '#328169',
                'primary-darker': '#2a6c58',
                'primary-light': '#64c3a6',
                'secondary': '#2C3E50',
                'secondary-dark': '#1f2d3a',
                'secondary-light': '#364d64',
                'secondary-lighter': '#4c6886',
                'background': '#f3f4f6',
                'text': '#454d5a',
                'text-light': '#6f7786',
                'card-background': '#ffffff',
                'border': '#dbdde1',
                'button-text': '#ffffff',
                'danger': '#d74f4f',
                'danger-dark': '#a94747',
                'danger-darker': '#803f3f',
                'success': '#53b17d',
                'badge-bg-1': '#b55f5f',
                'badge-bg-2': '#d39c68',
                'badge-bg-3': '#70609f',
                'badge-bg-4': '#346abb',
                'badge-bg-5': '#3c997d', // primary-color
                'badge-bg-6': '#36819a',
                'badge-bg-7': '#be5a87',
                'badge-bg-8': '#57667a',

                // Frontend Colors (from root.css)
                'fe-primary': '#977a82',
                'fe-secondary': '#e9ae9a',
                'fe-accent': '#f1ede4',
                'fe-primary-dark': '#4b383e',
                'fe-primary-light': '#b4979f',
                'fe-secondary-light': '#f8c2af',
                'fe-secondary-transparent': '#e9ae9a80',
                'fe-background': '#f5f5f5',
                'fe-background-dark': '#e1e1e1',
                'fe-background-transparent': '#f5f5f5a7',
                'fe-light-border': '#e2e2e2',
                'fe-spaceblack': '#303540',
                'fe-spacegrey': '#4f5c73',
                'fe-success': '#6dad58',
                'fe-danger': '#c94f51',
                'fe-warning': '#e2a755',
            },
            fontFamily: {
                sans: ['Barlow', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
