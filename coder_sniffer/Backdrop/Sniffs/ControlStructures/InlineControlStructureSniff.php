<?php
/**
 * Backdrop_Sniffs_ControlStructures_InlineControlStructureSniff.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Backdrop_Sniffs_ControlStructures_InlineControlStructureSniff.
 *
 * Verifies that inline control statements are not present. This Sniff overides
 * the generic sniff because Backdrop template files may use the alternative
 * syntax for control structures. See
 * http://www.php.net/manual/en/control-structures.alternative-syntax.php
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\ControlStructures;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Generic\Sniffs\ControlStructures\InlineControlStructureSniff as PHP_CodeSniffer_InlineControlStructureSniff;

class InlineControlStructureSniff extends PHP_CodeSniffer_InlineControlStructureSniff
{

    /**
     * Processes this test, when one of its tokens is encountered.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token in
     *                                        the stack passed in $tokens.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        // Check for the alternate syntax for control structures with colons (:).
        if (isset($tokens[$stackPtr]['parenthesis_closer'])) {
            $start = $tokens[$stackPtr]['parenthesis_closer'];
        } else {
            $start = $stackPtr;
        }
        $scopeOpener = $phpcsFile->findNext(T_WHITESPACE, ($start + 1), null, true);
        if ($tokens[$scopeOpener]['code'] === T_COLON) {
            return;
        }

        parent::process($phpcsFile, $stackPtr);

    }//end process()


}//end class

?>
