const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./**/*.blade.php'],
    safelist: [
        'top-13',
        'top-1/2',
        'w-1/2',
        'w-full'
    ],
    darkMode: 'class',
    theme: {
        extend: {
            spacing:{
                '13': '3.25rem'
            }
        },
    },
    plugins: [],
};
