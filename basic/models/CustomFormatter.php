<?php
namespace app\models;

define('NUMERAL_SIGN', 'minus');
define('NUMERAL_HUNDREDS_SUFFIX', 'hundert');
define('NUMERAL_INFIX', 'und');

global $lNumeral, $lTenner, $lGroupSuffix;

/* Die Zahlwörter von 0 bis 19. */
$lNumeral = array('null', 'ein', 'zwei', 'drei', 'vier',
    'fünf', 'sechs', 'sieben', 'acht', 'neun',
    'zehn', 'elf', 'zwölf', 'dreizehn', 'vierzehn',
    'fünfzehn', 'sechzehn', 'siebzehn', 'achtzehn', 'neunzehn');

/* Die Zehner-Zahlwörter. */
$lTenner = array('', '', 'zwanzig', 'dreißig', 'vierzig',
    'fünfzig', 'sechzig', 'siebzig', 'achtzig', 'neunzig');

/* Die Gruppen-Suffixe. */
$lGroupSuffix = array(array('s', ''),
    array('tausend ', 'tausend'),
    array('e Million ', ' Millionen '),
    array('e Milliarde ', ' Milliarden '),
    array('e Billion ', ' Billionen '),
    array('e Billiarde ', ' Billiarden '),
    array('e Trillion ', ' Trillionen '));


/**
 * Liefert das Zahlwort zu einer Ganzzahl zurück.
 * @global array $lNumeral
 * @param int $pNumber Die Ganzzahl, die in ein Zahlwort umgewandelt werden soll.
 * @return string Das Zahlwort.
 */
function num2text($pNumber)
{
    global $lNumeral;

    $nachkomma = '';
    if (strpos($pNumber, '.')) {
        $fraction = intval(substr(explode('.', $pNumber)[1], 0, 2));
        $nachkomma .= ' ' . $fraction . '/100';
    }

    if ($pNumber == 0) {
        return $lNumeral[0]; // „null“
    } elseif ($pNumber < 0) {
        return NUMERAL_SIGN . ' ' . num2text_group(abs($pNumber)) . $nachkomma;
    } else {
        return num2text_group($pNumber) . $nachkomma;
    }
}

/**
 * Rekursive Methode, die das Zahlwort zu einer Ganzzahl zurückgibt.
 * @global array $lNumeral
 * @global array $lTenner
 * @global array $lGroupSuffix
 * @param int $pNumber Die Ganzzahl, die in ein Zahlwort umgewandelt werden soll.
 * @param int $pGroupLevel (optional) Das Gruppen-Level der aktuellen Zahl.
 * @return string Das Zahlwort.
 */
function num2text_group($pNumber, $pGroupLevel = 0)
{
    global $lNumeral, $lTenner, $lGroupSuffix;

    /* Ende der Rekursion ist erreicht, wenn Zahl gleich Null ist */
    if ($pNumber == 0) {
        return '';
    }

    /* Zahlengruppe dieser Runde bestimmen */
    $lGroupNumber = $pNumber % 1000;

    /* Zahl der Zahlengruppe ist Eins */
    if ($lGroupNumber == 1) {
        $lResult = $lNumeral[1] . $lGroupSuffix[$pGroupLevel][0]; // „eine Milliarde“

        /* Zahl der Zahlengruppe ist größer als Eins */
    } elseif ($lGroupNumber > 1) {
        $lResult = '';

        /* Zahlwort der Hunderter */
        $lFirstDigit = floor($lGroupNumber / 100);

        if ($lFirstDigit > 0) {
            $lResult .= $lNumeral[$lFirstDigit] . NUMERAL_HUNDREDS_SUFFIX; // „fünfhundert“
        }

        /* Zahlwort der Zehner und Einer */
        $lLastDigits = $lGroupNumber % 100;
        $lSecondDigit = floor($lLastDigits / 10);
        $lThirdDigit = $lLastDigits % 10;

        if ($lLastDigits == 1) {
            $lResult .= $lNumeral[1] . 's'; // "eins"
        } elseif ($lLastDigits > 1 && $lLastDigits < 20) {
            $lResult .= $lNumeral[$lLastDigits]; // "dreizehn"
        } elseif ($lLastDigits >= 20) {
            if ($lThirdDigit > 0) {
                $lResult .= $lNumeral[$lThirdDigit] . NUMERAL_INFIX; // "sechsund…"
            }
            $lResult .= $lTenner[$lSecondDigit]; // "…achtzig"
        }

        /* Suffix anhängen */
        $lResult .= $lGroupSuffix[$pGroupLevel][1]; // "Millionen"
    }

    /* Nächste Gruppe auswerten und Zahlwort zurückgeben */
    return num2text_group(floor($pNumber / 1000), $pGroupLevel + 1) . $lResult;
}


class CustomFormatter extends \yii\i18n\Formatter
{
    /**
     * Liefert das Zahlwort zu einer Ganzzahl zurÃ¼ck.
     * @global array $lNumeral
     * @param int $pNumber Die Ganzzahl, die in ein Zahlwort umgewandelt werden soll.
     * @return string Das Zahlwort.
     */
    public function number2text($pNumber)
    {
        //Bsp.1:
        //bei Beträgen ab 7 Ziffern wird die Million als einzelnes Wort geschrieben
        //EUR 1. 632.505,02
        //(i. W.: Euro eine Million sechshundertzweiunddreißigtausendfünfhundertfünf 2/100)
        //
        //Bsp.2:
        //bei Beträgen bis 6 Ziffern wir ein Wort ausgeschrieben
        //EUR 632.505,02
        //(i. W.: Euro sechshundertzweiunddreißigtausendfünfhundertfünf 2/100)
        //
        //Bsp3:
        //bei glatten Beträgen
        //EUR 632.505,00
        //(i. W.: Euro sechshundertzweiunddreißigtausendfünfhundertfünf)

        return num2text($pNumber);
    }

}