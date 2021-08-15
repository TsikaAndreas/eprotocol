const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/components/**/*.blade.php',
        './resources/views/*.blade.php',
        '/css/*.css',
        '/js/**/*.js',
        '/js/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'city': "url('/assets/images/night_city.jpg')",
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
        },
    },

    plugins: [require('@tailwindcss/forms')],
    corePlugins: {
        outline: false,
    }
};
