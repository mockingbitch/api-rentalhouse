<?php

namespace PHP_CodeSniffer\Standards\PSR12\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

class OpenTagSniff implements Sniff
{
    /**
     * Register opentag
     *
     * @return array|mixed[]
     */
    public function register()
    {
        return [T_OPEN_TAG];
    }

    /**
     * Process check coding.
     *
     * @param  File $phpcsFile
     * @param  int  $stackPtr
     * @return int|void
     */
    public function process(File $phpcsFile, int $stackPtr)
    {
        if ($stackPtr !== 0) {
            return $phpcsFile->numTokens;
        }
        $next = $phpcsFile->findNext(T_INLINE_HTML, 0);
        if ($next !== false) {
            return $phpcsFile->numTokens;
        }
        $tokens = $phpcsFile->getTokens();
        $next = $phpcsFile->findNext(T_WHITESPACE, ($stackPtr + 1), null, true);
        if ($next === false) {
            return;
        }
        if ($tokens[$next]['line'] === $tokens[$stackPtr]['line']) {
            $error = 'Opening PHP tag must be on a line by itself';
            $fix = $phpcsFile->addFixableError($error, $stackPtr, 'NotAlone');
            if ($fix === true) {
                $phpcsFile->fixer->addNewline($stackPtr);
            }
        }
        return $phpcsFile->numTokens;
    }
}