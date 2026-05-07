import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', 'Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    green:  '#00FF87',
                    navy:   '#0A0F1E',
                    dark:   '#080C17',
                    card:   '#0F1629',
                    border: '#1A2340',
                    muted:  '#8892A4',
                },
            },
            animation: {
                'float':     'float 3s ease-in-out infinite',
                'pulse-slow':'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'slide-up':  'slideUp 0.6s ease-out forwards',
                'fade-in':   'fadeIn 0.8s ease-out forwards',
                'counter':   'counterUp 1s ease-out forwards',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0px)' },
                    '50%':      { transform: 'translateY(-10px)' },
                },
                slideUp: {
                    '0%':   { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                fadeIn: {
                    '0%':   { opacity: '0' },
                    '100%': { opacity: '1' },
                },
            },
            backdropBlur: {
                xs: '2px',
            },
            boxShadow: {
                'glow-green': '0 0 30px rgba(0, 255, 135, 0.3)',
                'glow-blue':  '0 0 30px rgba(69, 183, 209, 0.3)',
                'glass':      '0 8px 32px rgba(0, 0, 0, 0.4)',
            },
        },
    },

    plugins: [forms],
};
