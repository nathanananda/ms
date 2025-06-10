/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php", // mencakup semua blade file di views
        "./resources/js/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                GabaritoBold: ["Gabarito-Bold", "sans"],
                GabaritoRegular: ["Gabarito-Regular", "sans"],
                GabaritoBlack: ["Gabarito-Black", "sans"],
                GabaritoMedium: ["Gabarito-Medium", "sans"],
                GabaritoSemiBold: ["Gabarito-SemiBold", "sans"],
            },
        },
    },
    plugins: [],
};
