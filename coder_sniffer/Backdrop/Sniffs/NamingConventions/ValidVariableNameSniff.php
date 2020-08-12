<?php
/**
 * Backdrop_Sniffs_NamingConventions_ValidVariableNameSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Backdrop_Sniffs_NamingConventions_ValidVariableNameSniff.
 *
 * Checks the naming of member variables.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\NamingConventions;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\AbstractVariableSniff;

class ValidVariableNameSniff extends AbstractVariableSniff
{


    /**
     * Processes class member variables.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file being scanned.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     *
     * @return void
     */
    protected function processMemberVar(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $memberProps = $phpcsFile->getMemberProperties($stackPtr);
        if (empty($memberProps) === true) {
            return;
        }

        $memberName = ltrim($tokens[$stackPtr]['content'], '$');

        if (strpos($memberName, '_') !== false) {
            $error = 'Class property %s should use lowerCamel naming without underscores';
            $data  = array($tokens[$stackPtr]['content']);
            $phpcsFile->addError($error, $stackPtr, 'LowerCamelName', $data);
        }

    }//end processMemberVar()


    /**
     * Processes normal variables.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
     * @param int                  $stackPtr  The position where the token was found.
     *
     * @return void
     */
    protected function processVariable(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        $varName = ltrim($tokens[$stackPtr]['content'], '$');

        $phpReservedVars = array(
                            '_SERVER',
                            '_GET',
                            '_POST',
                            '_REQUEST',
                            '_SESSION',
                            '_ENV',
                            '_COOKIE',
                            '_FILES',
                            'GLOBALS',
                           );

        // If it's a php reserved var, then its ok.
        if (in_array($varName, $phpReservedVars) === true) {
            return;
        }

        // If it is a static public variable of a class, then its ok.
        if ($tokens[($stackPtr - 1)]['code'] === T_DOUBLE_COLON) {
            return;
        }

        if (preg_match('/[A-Z]/', $varName)) {
            $error = "Variable \"$varName\" is camel caps format. do not use mixed case (camelCase), use lower case and _";
            $phpcsFile->addError($error, $stackPtr, 'CamelCase');
        }

    }//end processVariable()


    /**
     * Processes variables in double quoted strings.
     *
     * @param PHP_CodeSniffer_File $phpcsFile The file where this token was found.
     * @param int                  $stackPtr  The position where the token was found.
     *
     * @return void
     */
    protected function processVariableInString(File $phpcsFile, $stackPtr)
    {
        // We don't care about variables in strings.

    }//end processVariableInString()


}//end class

?>
