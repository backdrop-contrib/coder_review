<?php
/**
 * Backdrop_Sniffs_WhiteSpace_ObjectOperatorSpacingSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Ensure that there are no white spaces before and after the object operator.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Util\Tokens;

class ObjectOperatorSpacingSniff implements Sniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        return array(T_OBJECT_OPERATOR);

    }//end register()


    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $prevToken = $phpcsFile->findPrevious(Tokens::$emptyTokens, $stackPtr - 1, null, true);
        // Line breaks are allowed before an object operator.
        if ($tokens[$stackPtr]['line'] === $tokens[$prevToken]['line']
            && $prevToken < ($stackPtr - 1)
        ) {
            $error = 'Space found before object operator';
            $phpcsFile->addError($error, $stackPtr, 'Before');
        }

        $nextType = $tokens[($stackPtr + 1)]['code'];
        if (in_array($nextType, Tokens::$emptyTokens) === true) {
            $error = 'Space found after object operator';
            $phpcsFile->addError($error, $stackPtr, 'After');
        }

    }//end process()


}//end class
