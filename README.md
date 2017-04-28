![alt text](http://listingslab.com/wp-content/uploads/2017/03/cropped-android-chrome-384x384.png "Listingslab Beaker Logo")
## vs 1.0.4

### Progressive Web App for Magento

A front end for Magento which bypasses the usual V in
Magento's MVC and instead interfaces directly with the
system's JSON API. Project home on 
[Listingslab.com](http://listingslab.com/magepwa/?ref=README.md "Mothership")

#### Prerequisites
* git
* node -v > 6.x
* npm -v > 3.x
* Vagrant

#### Installation

cd to your working directory and run the following to see a 
list of the files & folders in the repo.

```
git clone git@github.com:listingslab/magento-pwa.xyz.git
cd magento-pwa.xyz
ls -l
```

There are 3 folders to consider:
* magento-1.9.3.2 (Magento 1 installation)
* magento-2.1.6 (Magento 2 installation)
* magepwa (source files for the PWA)

#### Step 1 - Vagrant Up
 
To run our Magento environments we will be using Vagrant.