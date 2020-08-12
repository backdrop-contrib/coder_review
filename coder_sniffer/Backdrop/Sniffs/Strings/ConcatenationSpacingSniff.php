<?php
/**
 * Backdrop_Sniffs_Strings_ConcatenationSpacingSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Peter Philipp <peter.philipp@cando-image.com>
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Backdrop_Sniffs_Strings_ConcatenationSpacingSniff.
 *
 * Makes sure there are the needed spaces between the concatenation operator (.) and
 * the strings being concatenated.
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Peter Philipp <peter.philipp@cando-image.com>
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\Strings;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class Backdrop_Sniffs_Strings_ConcatenationSpacingSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_STRING_CONCAT);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE || $tokens[($stackPtr + 1)]['code'] !== T_WHITESPACE) {
            $message = 'Concat operator must be surrounded by spaces';
            $phpcsFile->addError($message, $stackPtr, 'Missing');
        }
    }
}//end class
