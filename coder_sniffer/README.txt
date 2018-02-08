-------------------------------------------------------------------------------
                            Backdrop Code Sniffer
-------------------------------------------------------------------------------

Backdrop Code Sniffer is a coding standard validation tool for Backdrop and contributed
modules/themes.

Online documentation: https://www.drupal.org/node/1419980


Installation: PEAR
------------------

Requirements:
  - PEAR
  - PHPCS 1.4.1 or newer

- Install PEAR  ( http://pear.php.net/manual/en/installation.php )
- Install PHPCS ( http://pear.php.net/package/PHP_CodeSniffer )
- Sym-link the backdropcs directory into the standards folder for PHP_CodeSniffer.
  The code for that looks like this:

$> sudo ln -sv /path/to/coder/coder_sniffer/Backdrop $(pear config-get php_dir)/PHP/CodeSniffer/Standards

Please see the online documentation for more detailed instructions:

  https://www.drupal.org/node/1419988


Installation: Drush
-------------------

While Coder Sniffer can be used as a standalone set of rules for PHP_CodeSniffer,
drush command support is included to facilitate ease of use, installation,
and leveraging of drush features such as site aliasing.

Extract the contents of the Coder project into one of the locations specified
in the drush README.txt COMMANDS section, such as the subdirectory of the
.drush folder in your home directory.  For other alternatives, please see
https://www.drupal.org/node/1419988


Installation: Composer
----------------------

You can also use Coder Sniffer as a library with Composer:

    "require": {
        "backdrop/coder": "*"
    }

"composer install" will fetch all necessary dependencies and you can then use/execute
PHPCS locally in your project:

./vendor/bin/phpcs --standard=coder_sniffer/Backdrop /path/to/code/to/review


Usage (running in a shell)
--------------------------

$> phpcs --standard=Backdrop --extensions=php,module,inc,install,test,profile,theme /path/to/backdrop_module

Usage (drush)
-------------

$> drush backdropcs sites/all/modules/custom

Working with Editors
--------------------
Backdrop Code Sniffer can be used with various editors.

Editors:

eclipse: https://www.drupal.org/node/1420004
Komodo: https://www.drupal.org/node/1419996
Netbeans: https://www.drupal.org/node/1420008
Sublime Text: https://www.drupal.org/node/1419996
vim: https://www.drupal.org/node/1419996


Attention
---------
This is still a draft!!
Please cross check with https://api.backdropcms.org/coding-standards and
https://github.com/backdrop-contrib/coder_review if the validation is correct.

Known Issues:
Documentation Tags just rarely supported - there are many missing / disabled
sniffs.
