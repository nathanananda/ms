/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/views/**/*.blade.php", // mencakup semua blade file di views
        "./resources/js/**/*.js",
        "./resources/**/*.vue",
    ],
    safelist: [
        "bg-[#137D28]",
        "bg-[#F8901F]",
        "bg-[#1FB7F8]",
        "bg-[#00668C]",
        "bg-[#D3A409]",
        "bg-[#565656]",
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
