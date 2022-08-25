/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
        screens: {
            mobile: "320px",
            desktop: "900px",
        },
    },
    plugins: [require("daisyui")],
};
