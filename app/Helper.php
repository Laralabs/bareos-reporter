<?php
/**
 * Bareos Reporter
 * Application for managing Bareos Backup Email Reports
 *
 * Helper Class
 *
 * @license The MIT License (MIT) See: LICENSE file
 * @copyright Copyright (c) 2016 Matt Clinton
 * @author Matt Clinton <matt@laralabs.uk>
 * @website http://www.magelabs.uk/
 */

namespace App;

class Helper
{
    /**
     * secondsToTime function.
     *
     * Credit to: http://stackoverflow.com/a/19680778
     *
     * @param $seconds
     * @return string
     */
    public static function secondsToTime($seconds) {
        if(!empty($seconds))
        {
            $dtF = new \DateTime("@0");
            $dtT = new \DateTime("@$seconds");
            return $dtF->diff($dtT)->format('%a Days');
        }
        else
        {
            return '';
        }
    }
}
