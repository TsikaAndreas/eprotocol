const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/*.blade.php',
        './resources/**/*.scss',
        './resources/**/*.css'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'custom-indigo':'#7579ff',
                'custom-purple':'#b224ef',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
            backgroundColor: ['odd', 'even'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
    corePlugins: {
        outline: false,
    }
};
