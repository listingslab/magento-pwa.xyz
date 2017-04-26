![alt text](http://listingslab.com/wp-content/uploads/2017/03/cropped-android-chrome-384x384.png "Listingslab Beaker Logo")
#  www.magento-pwa.xyz vs 1.0.1

## Developer Installation

Clone the repository & cd to directory and run start.sh to install dependencies, then run `npm start` to start the server on http://localhost:3000/ and open that url in your default browser. Running `npm run open` will open the browser for you

Then run

`npm start` to start webpack dev server which will recompile the JavaScript app on change

### NPM Scripts

`npm start`
Runs webpack dev server in inline mode which means hot module auto browser updting magic.

`npm build`
Compiles ES6 react app into a production version transpiled into ES5

---


### Using Atom editor?

Install IDE linting. It's proper helpful

`apm install linter-eslint`

`apm install linter-stylelint`