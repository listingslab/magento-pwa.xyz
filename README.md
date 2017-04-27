![alt text](http://listingslab.com/wp-content/uploads/2017/03/cropped-android-chrome-384x384.png "Listingslab Beaker Logo")
#  magento-pwa.xyz vs 1.0.3

## Progressive Web App View for Magento

A front end for Magento which bypasses the usual V in
Magento's MVC and instead interfaces directly with the
system's JSON API. Project home on Listingslab.com](http://listingslab.com/magento-pwa?ref=README.md "Mothership")

### Prerequisites
* node -v > 6.x
* npm -v > 3.x
* git

### Installation

cd to your working directory and run
```
git clone git@github.com:listingslab/magento-pwa.xyz.git
cd magento-pwa.xyz
sudo npm install
```

## Vagrant up

```
npm run webpack
```

#### What are PWAs?

* Progressive – Works for every user, regardless of browser choice because it’s built with progressive enhancement as a core tenet.
* Responsive – Fits any form factor: desktop, mobile, tablet, or whatever is next.
* Connectivity independent – Enhanced with service workers to work offline or on low-quality networks.
* App-like – Feels like an app to the user with app-style interactions and navigation because it’s built on the app shell model.
* Fresh – Always up-to-date thanks to the service worker update process.
* Safe – Served via HTTPS to prevent snooping and to ensure content hasn’t been tampered with.
* Discoverable – Is identifiable as an “application” thanks to W3C manifest and service worker registration scope, allowing search engines to find it.
* Re-engageable – Makes re-engagement easy through features like push notifications.
* Installable – Allows users to “keep” apps they find most useful on their home screen without the hassle of an app store.
* Linkable – Easily share via URL, does not require complex installation.

[Learn more from Google](https://codelabs.developers.google.com/codelabs/your-first-pwapp/#0 "Google")

---

### Using Atom editor?

Install IDE linting. It's proper helpful

`apm install linter-eslint`

`apm install linter-stylelint`
