<?php
/**
 * Partitaiva.php
 */
Namespace Wraps;

/**
 * Class Partitaiva
 * php version >= 7.1
 *
 * @category   PHP
 * @package    Wraps_Utilities
 * @subpackage Wraps_Utilities_Partitaiva
 * @author     Walter Raponi <walter.raponi@gmail.com>
 * @license    https://opensource.org/licenses/MIT MIT License
 * @version    1.0.0
 * @link       https://github.com/raponiwalter/partitaiva
 */
class Partitaiva
{
    /**
     * @param int|string $piva partita iva
     * 
     * @return bool
     */
    public function isPartitaiva($piva) : bool
    {
        if (!$this->checkSyntaxPartitaiva($piva)) {
            return false;
        }

        $somma          = 0;
        $controllo      = 0;
        $splittedString = str_split(trim($piva));
        $lastChar       = array_pop($splittedString);

        foreach ($splittedString as $key => $char) {
            $somma += $this->_addendum($key, $char);
        }

        $resto = $somma % 10;

        if ($resto) {
            $controllo = 10 - $resto;
        }

        return ($controllo == $lastChar);
    }

    /**
     * @param int|string $piva partita iva
     * 
     * @return bool
     */
    public function checkSyntaxPartitaiva($piva) : bool
    {
        if (!$this->_allowedType($piva)) {
            return false;
        }
        return preg_match('/^[0-9]{11}$/', trim($piva));
    }

    /**
     * Controlla se un carattere o una cifra è pari o dispari
     *
     * @param string|int $what carattere o cifra da controllare
     * 
     * @return bool
     */
    private function _isOdd($what) : bool
    {
        return ($what & 1);
    }

    /**
     * @param int|string $what partita iva
     * 
     * @return string
     */
    private function _allowedType($what) : bool
    {
        return (is_string($what) || is_int($what)) && !empty($what);
    }

    /**
     * @param int|string $position posizione del carattere
     * @param int|string $char     numero da controllare
     * 
     * @return int
     */
    private function _addendum($position, $char) : int
    {
        $add = $char;
        if ($this->_isOdd($position)) {
            $add = $char * 2;
            if ($add > 9) {
                $add -= 9;
            }
        }
        return $add;
    }
}