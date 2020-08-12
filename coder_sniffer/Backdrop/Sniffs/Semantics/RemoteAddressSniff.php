<?php
/**
 * Backdrop_Sniffs_Semantics_RemoteAddressSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Make sure that the function ip_address() is used instead of
 * $_SERVER['REMOTE_ADDR'].
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\Semantics;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class RemoteAddressSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_VARIABLE);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being processed.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $string = $phpcsFile->getTokensAsString($stackPtr, 4);
        if ($string === '$_SERVER["REMOTE_ADDR"]' || $string === '$_SERVER[\'REMOTE_ADDR\']') {
            $error = 'Use the function ip_address() instead of $_SERVER[\'REMOTE_ADDR\']';
            $phpcsFile->addError($error, $stackPtr, 'RemoteAddress');
        }

    }//end process()


}//end class

?>
