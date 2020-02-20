const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const CleanWebpackPlugin = require("clean-webpack-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

const settings = {
	host: 'localhost',
	port: 5500,
	proxy: 'fictionaluniversity.local', //Actual WordPress Address site (default: localhost)
};

const autoprefixer = require("autoprefixer");
const autoprefixerConfig = {
  browsers: ["last 5 versions", "> 3%"]
};

const postCSSPlugins = [
  require("postcss-import"),
  require("postcss-mixins"),
  require("postcss-simple-vars"),
  require("postcss-nested"),
  require("postcss-hexrgba"),
  autoprefixer
];

module.exports = {
  entry: ['./src/scripts/app.js', './src/styles/app.css'],
  output: {
    filename: './assets/js/app.min.js',
    path: path.resolve(__dirname)
  },
  module: {
    rules: [{
        test: /\.scss$/,
        exclude: /(node_modules)/,
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              plugins: {
                autoprefixer: autoprefixerConfig
              }
            }
          },
          "sass-loader"
        ]
      },
      {
        test: /\.css$/,
        exclude: /(node_modules)/,
        use: [
          MiniCssExtractPlugin.loader,
          "css-loader",
          {
            loader: "postcss-loader",
            options: {
              plugins: postCSSPlugins
            }
          }
        ]
      },
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"]
          }
        }
      }
    ]
  },
  
  plugins: [
    new MiniCssExtractPlugin({
      filename: './assets/css/app.min.css'
    }),
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ['./assets/js/*', './assets/css/*']
    }),
    new BrowserSyncPlugin({
			host: settings.host,
      port: settings.port,
      notify: false,
      proxy: settings.proxy,
      files: [
        './**/*.php',
        '!./node_modules',
        '!./package.json',
      ],
      reloadDelay: 0,
		})
  ],

  optimization: {
    minimizer: [
      new UglifyJSPlugin({
        cache: true,
        parallel: true
      }),
      new OptimizeCSSAssetsPlugin({}),
    ]
  }
};
