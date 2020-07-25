const mix = require("laravel-mix");
const webpack = require('webpack');
const LiveReloadPlugin = require("webpack-livereload-plugin");
require('laravel-mix-merge-manifest');

const livereload = process.env.NODE_ENV == 'development' ? [new LiveReloadPlugin()] : [];
mix.webpackConfig({
  plugins: [
      ...livereload,
      new webpack.ProvidePlugin({
          "window.Quill": "quill/dist/quill.js",
          Quill: "quill/dist/quill.js"
      })
  ],
  resolve: {
      extensions: [".js", ".vue"],
      alias: {
          "@": __dirname + "/resources"
      }
  }
});


mix
    .js('resources/js/BE/app.js', 'public/js/be.js')
    .js('resources/js/FE/app.js', 'public/js/app.js')
    .sourceMaps()
    .version();

mix.mergeManifest();
