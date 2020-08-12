<?php
/**
 * Backdrop_Sniffs_WhiteSpace_OperatorSpacingSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Overrides Squiz_Sniffs_WhiteSpace_OperatorSpacingSniff to not check inline if/then
 * statements because those are handled by
 * Backdrop_Sniffs_Formatting_SpaceInlineIfSniff.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
namespace Backdrop\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace\OperatorSpacingSniff as Squiz_OperatorSpacingSniff;
use PHP_CodeSniffer\Util\Tokens;

class OperatorSpacingSniff extends Squiz_OperatorSpacingSniff
{


    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $comparison = Tokens::$comparisonTokens;
        $operators  = Tokens::$operators;
        $assignment = Tokens::$assignmentTokens;

        return array_unique(
            array_merge($comparison, $operators, $assignment)
        );

    }//end register()


}//end class
