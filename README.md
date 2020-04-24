# Integration
Integration modules allows Magento integrating with other platforms such as Odoo, Akeneo

## How to install
This bundle modules are not available for composer for now. Before installing these modules, we need to install the base module first.

`composer require boolfly/module-base`

Then, download them, put all under `app/Boolfly` folder.


## Technical Guide
  Following the Magento Payment design patterns to build the module architecture: https://devdocs.magento.com/guides/v2.3/payments-integrations/payment-gateway/payment-gateway-intro.html
<ul>
  <li>Command design pattern: https://refactoring.guru/design-patterns/command</li>
  <li>Builder design pattern: https://refactoring.guru/design-patterns/builder</li>
  <li>Chain of Command to handle the response: https://refactoring.guru/design-patterns/chain-of-responsibility</li>
</ul>

We need to understand type and virtual type in Magento.

Will update more

## Best Practice
We need to follow Magento coding standard: https://devdocs.magento.com/guides/v2.3/coding-standards/code-standard-php.html


## TODO
<ul>
  <li>Use Queue</li>
  <li>Implementing catalog: product and category </li>
  <li>Customer integration</li>
</ul>

## User Guide

### 1. Order Integration
We can map the fields between Magento and Integration platform. **STORES > Configuration > BOOLFLY > Integration > Order Integration General Settings**

![Boolfly Integration Sales mapping fields](https://github.com/boolfly/wiki/blob/master/magento/magento2/images/integration/integration-sales-01.png)
<ul>
  <li>Enabled: enabled/disabled order integration</li>
  <li>External Url: API url of integration system</li>
  <li>Username: API authentication username</li>
  <li>Password: API authentication password</li>
  <li>Mapping Fields: the basic mapping fields between Magento and integration system</li>
  <li>Debug: enabled/disabled integration log</li>
</ul>
