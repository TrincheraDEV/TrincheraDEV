import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./vendor/livewire/flux-pro/stubs/**/*.blade.php",
        "./vendor/livewire/flux/stubs/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    'light': '#6991c9',
                    DEFAULT: '#336bb3',
                    dark: '#000e22',
                },
                secondary: {
                    DEFAULT: '#23282d',
                },
            },
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                sans: ['Inter', 'sans-serif'],
            },
        },
    },

    plugins: [forms, typography],
};
