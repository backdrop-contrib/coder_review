<?php
/**
 * Backdrop_Sniffs_CSS_ClassDefinitionOpeningBraceSpaceSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Ensure there is a single space before the opening brace in a class definition
 * and the content starts on the next line. Copied from
 * Squiz_Sniffs_CSS_ClassDefinitionOpeningBraceSpaceSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\CSS;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class ClassDefinitionOpeningBraceSpaceSniff implements Sniff
{

    /**
     * A list of tokenizers this sniff supports.
     *
     * @var array
     */
    public $supportedTokenizers = array('CSS');


    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return array(T_OPEN_CURLY_BRACKET);

    }//end register()


    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if ($tokens[($stackPtr - 1)]['code'] !== T_WHITESPACE) {
            $error = 'Expected 1 space before opening brace of class definition; 0 found';
            $phpcsFile->addError($error, $stackPtr, 'NoneBefore');
        } else {
            $content = $tokens[($stackPtr - 1)]['content'];
            if ($content !== ' ') {
                $length = strlen($content);
                if ($length === 1) {
                    $length = 'tab';
                }

                $error = 'Expected 1 space before opening brace of class definition; %s found';
                $data  = array($length);
                $phpcsFile->addError($error, $stackPtr, 'Before', $data);
            }
        }//end if

        $end = $tokens[$stackPtr]['bracket_closer'];
        // Do not check nested style definitions as, for example, in @media style rules.
        $nested = $phpcsFile->findNext(T_OPEN_CURLY_BRACKET, ($stackPtr + 1), $end);
        if ($nested !== false) {
            return;
        }

        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if ($next !== false && $tokens[$next]['line'] !== ($tokens[$stackPtr]['line'] + 1)) {
            $error = 'Expected exactly one new line after opening brace of class definition';
            $phpcsFile->addError($error, $stackPtr, 'After');
        }

    }//end process()


}//end class

?>
