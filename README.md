# Magento 2 FAQ Extension

## Installation
##### Using Composer

 * Include the repository: `composer require rukhsar/faq`
 * Enable the extension: `php bin/magento --clear-static-content module:enable Rukhsar_Faq`
 * Upgrade db scheme: `php bin/magento setup:upgrade`
 * Clear cache: `php bin/magento cache:clean && bin/magento cache:flush`

##### Manually (not recommended)
 * Download Faq Extension
 * Unzip the magento2-faq-master.zip file
 * Create folders {Magento 2 root}/app/code/Rukhsar/Faq
 * Copy all folders and files to Faq folder

##### Step 2 - Enable/Install via command line
 * php bin/magento module:enable Rukhsar_Faq
 * php bin/magento setup:upgrade
 * php bin/magento cache:flush
 * php bin/magento cache:clean

## Usage

This module will provide a frontend route `faq` which can be used to load faq page.


## Feedback

If you have any inquiry please contact with me via email.
* Email: [rukhsar.man@gmail.com](mailto:rukhsar.man@gmail.com)
