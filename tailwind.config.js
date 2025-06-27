// tailwind.config.js
import preset from "./vendor/filament/support/tailwind.config.preset";

export default {
  presets: [preset],
  content: [
    "./app/Filament/**/*.php",
    "./resources/views/filament/**/*.blade.php",
    "./vendor/filament/**/*.blade.php",

    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.js",

    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require("flowbite/plugin"),
  ],
};
