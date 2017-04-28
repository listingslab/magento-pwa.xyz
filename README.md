![alt text](http://listingslab.com/wp-content/uploads/2017/03/cropped-android-chrome-384x384.png "Listingslab Beaker Logo")
## vs 1.0.4

### Progressive Web App for Magento

A front end for Magento which bypasses the usual V in
Magento's MVC and instead interfaces directly with the
system's JSON API. Project home on 
[Listingslab.com](http://listingslab.com/magepwa/?ref=README.md)

#### Prerequisites
* git
* node -v > 6.x
* npm -v > 3.x
* Vagrant

#### Installation

cd to your working directory and run the following to see a 
list of the files & folders in the repo.

```
git clone git@github.com:listingslab/magento-pwa.xyz.git magepwa
cd magepwa
ls -l
```

Open the magepwa folder in your IDE.
There are 3 folders to consider:
* magento-1.9.3.2 (Magento 1 installation)
* magento-2.1.6 (Magento 2 installation)
* magepwa (source files for the PWA)

#### Step 1 - Vagrant Up
 
To run our Magento environments we will be using Vagrant. 
If you are unfamiliar with Vagrant, get up to speed here 
[here](https://www.vagrantup.com/intro/index.html). Once 
you're ready, take a look at the Vagrant file. We will be
using the _ubuntu/trusty64_ box to create a simple LAMP 
stack. 

#### Step 2 - Magento
