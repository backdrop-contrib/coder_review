<?php
/**
 * Backdrop_Sniffs_Files_LineLengthSniff.
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * Checks comment lines in the file, and throws warnings if they are over 80
 * characters in length.
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */

namespace Backdrop\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Files\LineLengthSniff as PHP_CodeSniffer_LineLengthSniff;

class LineLengthSniff extends PHP_CodeSniffer_LineLengthSniff
{

    /**
     * The limit that the length of a line should not exceed.
     *
     * @var int
     */
    public $lineLimit = 80;

    /**
     * The limit that the length of a line must not exceed.
     * But just check the line length of comments....
     *
     * Set to zero (0) to disable.
     *
     * @var int
     */
    public $absoluteLineLimit = 0;

    /**
     * Variable to store the code from each line of the file so that the
     * complete line can be checked with regular expressions.
     *
     * @var array
     */
    public $code = array();

    /**
     * Checks if a line is too long.
     *
     * @param PHP_CodeSniffer_File $phpcsFile   The file being scanned.
     * @param int                  $stackPtr    The token at the end of the line.
     * @param string               $lineContent The content of the line.
     *
     * @return void
     */
    protected function checkLineLength($phpcsFile, $tokens, $stackPtr)
    {

      if (empty($this->code)) {
        foreach ($tokens as $token) {
          if (isset($this->code[$token['line']])) {
            $this->code[$token['line']] .= $token['content'];
          }
          else {
            $this->code[$token['line']] = $token['content'];
          }
        }
      }

      if (isset($tokens[$stackPtr])) {
          if (preg_match('/^[[:space:]]*(\/\*)?\*[[:space:]]*@link.*@endlink[[:space:]]*/', $this->code[$tokens[$stackPtr]['line']]) === 1) {
              // Allow @link documentation to exceed the 80 character limit.
              return;
          }

          if (preg_match('/^[[:space:]]*((\/\*)?\*|\/\/)[[:space:]]*@see.*/', $this->code[$tokens[$stackPtr]['line']]) === 1) {
              // Allow @see documentation to exceed the 80 character limit.
              return;
          }

          parent::checkLineLength($phpcsFile, $tokens, $stackPtr);
      }

    }//end checkLineLength()


    /**
     * Returns the length of a defined line.
     *
     * @return integer
     */
    public function getLineLength(File $phpcsFile, $currentLine)
    {
        $tokens = $phpcsFile->getTokens();

        $tokenCount         = 0;
        $currentLineContent = '';

        $trim = (strlen($phpcsFile->eolChar) * -1);
        for (; $tokenCount < $phpcsFile->numTokens; $tokenCount++) {
            if ($tokens[$tokenCount]['line'] === $currentLine) {
                $currentLineContent .= $tokens[$tokenCount]['content'];
            }
        }

        return strlen($currentLineContent);

    }//end getLineLength()


}//end class
