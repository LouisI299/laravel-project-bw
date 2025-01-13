import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            height: {
                13: "3.25rem",
                15: "3.75rem",
                18: "4.5rem",
                22: "5.5rem",
                36: "9rem",
                "1/2": "50%",
                "3/4": "75%",
            },
            width: {
                13: "3.25rem",
                15: "3.75rem",
                18: "4.5rem",
                22: "5.5rem",
                36: "9rem",
                "1/2": "50%",
                "3/4": "75%",
                "1/3": "33.333333%",
                "2/3": "66.666667%",
            },
        },
    },

    plugins: [forms],
};
