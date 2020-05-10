<?php

/**
 * Static functions that assist in generating HTML go in this class.
 *
 */
class HTMLHelper {
	

    /**
     * Generate an HTML list of linked tag words
     *
     * @param array $items Array of tag words
     * @param string $link sprintf()-style link format string
     * @param string optional $delimiter Link delimiter
     * @return string
     */
    public static function tagLinkList($items, $link, $delimiter = ', ') {
        $html = array();
        if (count($items) == 0) return "None";
        foreach($items as $item => $count) {
            $urlItem = urlencode($item);
            $htmlItem = htmlentities($item, ENT_QUOTES, 'UTF-8');
            $html[] = '<a class="tag" href="http://'.$_SERVER['HTTP_HOST'].'/' . sprintf($link,$urlItem) . '">' . $htmlItem . '</a>';
        }
        return implode($html, $delimiter);
    }
    
    /**
     * Simple English word pluralizer. No irregulars handled.
     *
     * @param string $word Word to possible pluralize
     * @param string $count Number to determine plural form
     * @return string
     */
    function pluralize($word, $count) {
        if ($count == 1) {
            return $word;
        } else if (substr($word, -2) == 'ey') {
            return $word.'s';
        } else if (substr($word, -1) == 'y') {
            return substr($word, 0, -1).'ies';
        } else if (substr($word, -2) == 'ch') {
            return $word.'es';
        }

        return $word.'s';
    }

    // Note that this uses elapsed time, not clock time, 
    // so there may be some DST wackiness 
    public static function prettyDate($date) { 
        $stamp = strtotime($date); 
        $diff = $stamp - time(); 
        if ($diff > 0) { // future 
            if ($diff > 86400 * 7) { 
                if (date('Y') == date('Y',$stamp)) { 
                    return date('M j, g:ia', $stamp);  
                } else { 
                    return date('M j Y, g:ia', $stamp);  
                } 
            } else if ($diff > 86400) { 
                $days = floor($diff/86400); 
                return "in $days " . self::pluralize('day',$days); 
            } else if ($diff > 3600) { 
                $hours = floor($diff/3600); 
                return "in $hours " . self::pluralize('hour',$hours); 
            } else if ($diff > 60) { 
                $minutes = floor($diff/60); 
                return "in $minutes " . self::pluralize('minute',$minutes); 
            } else { 
                return "in $diff " .self::pluralize('second',$seconds); 
            } 
        } else { // past 
            if ($diff < 86400 * 7) { 
                if (date('Y') == date('Y',$stamp)) { 
                    return date('M j, g:ia', $stamp);  
                } else { 
                    return date('M j Y, g:ia', $stamp);  
                } 
            } else if ($diff < 86400) { 
                $days = abs(floor($diff/86400)); 
                return "$days " . self::pluralize('day',$days) . ' ago'; 
            } else if ($diff < 3600) { 
                $hours = abs(floor($diff/3600)); 
                return "$hours " . self::pluralize('hour',$hours) . ' ago'; 
            } else if ($diff < 60) {                 
                $minutes = abs(floor($diff/60)); 
                return "$minutes " . self::pluralize('minute',$minutes) . ' ago'; 
            } else { 
                return "$diff ". self::pluralize('second',$diff) . ' ago'; 
            } 
        } 
    } 

}
