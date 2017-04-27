/**
 * Created by Chris Dorward on 21/04/2017
 * webpack config for a production build
 */

const path = require('path');
const webpackFactory = require('webpack'); //to access built-in plugins
const CopyWebpackPlugin = require('copy-webpack-plugin'); //installed via npm
const CleanWebpackPlugin = require('clean-webpack-plugin') //installed via npm
const webpack = require('webpack'); //to access built-in plugins

// the path(s) that should be cleaned
let pathsToClean = [
  'www/mpwa'
]

module.exports = {
  entry: "./src/index",
  output: {
    path: path.resolve(__dirname, "www/magepwa"),
    filename: "magepwa.js"
  },
  plugins: [
    // new CleanWebpackPlugin(pathsToClean),
    new webpackFactory.optimize.UglifyJsPlugin(),
    new CopyWebpackPlugin([
        { from: 'skin' }
    ])
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['env']
          }
        }
      }
    ]
  }
}
