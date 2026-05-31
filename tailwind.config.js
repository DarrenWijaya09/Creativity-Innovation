import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    /*
    |--------------------------------------------------------------------------
    | DARK MODE
    |--------------------------------------------------------------------------
    |
    | Use class strategy for manual dark mode toggle
    |
    */

    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            /*
            |--------------------------------------------------------------------------
            | FONT FAMILY
            |--------------------------------------------------------------------------
            */

            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },

            /*
            |--------------------------------------------------------------------------
            | CUSTOM COLORS (OPTIONAL BUT RECOMMENDED)
            |--------------------------------------------------------------------------
            */

            colors: {
                primary: "#2563eb",

                dark: {
                    DEFAULT: "#0f172a",
                    secondary: "#111827",
                    tertiary: "#1f2937",
                    border: "#374151",
                    muted: "#9ca3af",
                },
            },

            /*
            |--------------------------------------------------------------------------
            | BOX SHADOWS
            |--------------------------------------------------------------------------
            */

            boxShadow: {
                soft: "0 4px 20px rgba(0,0,0,0.06)",

                "soft-dark": "0 4px 20px rgba(0,0,0,0.35)",
            },
        },
    },

    plugins: [forms],
};
