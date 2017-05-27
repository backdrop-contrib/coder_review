Coder Review
============

This is a developer Module that assists with code review so contributed modules
can define additional review standards.

Built-in support for:
 - Backdrop Coding Standards - http://backdrop.org/node/318
 - Handle text in a secure fashion - http://backdrop.org/node/28984

Coder Sniffer
-------------

See the README.txt file in the coder_sniffer directory.


Installation
------------

Copy coder.module to your module directory and then enable on the admin
modules page.  Enable the modules that admin/config/development/coder/settings
works on, then view the coder results page at coder.


Automated Testing (PHPUnit)
---------------------------

Coder Sniffer comes with a PHPUnit test suite to make sure the sniffs work 
correctly.
Use Composer to install the dependencies:

  composer install

Then execute the tests:

  ./vendor/bin/phpunit


License
-------

This project is GPL v2 software. See the LICENSE.txt file in this directory for
complete text.

Current Maintainers
-------------------

- [docwilmot](https://github.com/docwilmot)

Credits
-------

Doug Green
douggreen@douggreenconsulting.com
