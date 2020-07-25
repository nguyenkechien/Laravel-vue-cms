const mix = require("laravel-mix");
require("laravel-mix-merge-manifest");

mix
  .sass("resources/sass/FE/app.scss", "public/css/app.css")
  .sass("resources/sass/BE/app.scss", "public/css/be.css")
  .sourceMaps()
  .version();

mix.mergeManifest();
