# FroshPerformance

[![Join the chat at https://gitter.im/FriendsOfShopware/Lobby](https://badges.gitter.im/FriendsOfShopware/Lobby.svg)](https://gitter.im/FriendsOfShopware/Lobby)
[![Travis CI](https://travis-ci.org/FriendsOfShopware/FroshPerformance.svg?branch=master)](https://travis-ci.org/FriendsOfShopware/FroshPerformance)
[![Download @ Community Store](https://img.shields.io/badge/endpoint.svg?url=https://frosh.shyim.de/FroshPerformance)](https://store.shopware.com/en/frosh31872894918f/performance-improvements.html)


Performance Improvements for Shopware

## Versions

* FroshPerformance = Shopware 5
* [FroshPlatformPerformance](https://github.com/FriendsOfShopware/FroshPlatformPerformance) = Shopware Platform


### Features

* Removes Shopware Querystring from font
* Minify Html Output (Included with Shopware 5.6)
* Http 2 Server Push (Included with Shopware 5.6)
* Caching of plugin configuration (Included with Shopware 5.6)
* [Purify-CSS](https://github.com/purifycss/purifycss) Integration

## Requirements

- min Shopware 5.4.0


# Installation

## Zip Installation package for the Shopware Plugin Manager

* Download the [latest plugin version](https://github.com/FriendsOfShopware/FroshPerformance/releases/latest/) (e.g. `FroshPerformance-1.0.0.zip`)
* Upload and install plugin using Plugin Manager

## Git Version
* Checkout Plugin in `/custom/plugins/FroshPerformance`
* Change to Directory and run `composer install` to install the dependencies
* Install the Plugin with the Plugin Manager

## Install with composer
* Change to your root Installation of shopware
* Run command `composer require frosh/performance` and install and activate the plugin in the Plugin Manager 


## Contributing

Feel free to fork and send pull requests!


## Licence

This project uses the [MIT License](LICENCE.md).
