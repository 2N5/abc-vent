<?php
class Helper
{
    public static function cutText($string, $start = 0, $offset = 250, $encode = 'UTF-8')
    {
//        $string = str_replace('[uds:url]', '', $string);
//        $string = preg_replace('/\s?\[(uds|cat):[a-zA-Z-]+\]\s?/', '', $string);
		
        if(mb_strlen($string) < $offset)
        {
            return $string;
        }
        
        $lenght = self::lenght($string, $offset, $encode);
        return mb_substr($string, $start, $lenght, $encode);
    }
    
    private static function lenght($content, $offset, $encode)
    {
        $positions = array();
        $bingo = array(' ',',','.','!','?');
        
        if(in_array(mb_substr($content, $offset, 1, $encode), $bingo))
        {
            return $offset;
        }
        
        foreach ($bingo as $needle)
        {
            $pos = (int)mb_strpos($content, $needle, $offset, $encode);
            if($pos > 0)
            {
                $positions[] = $pos;
            }
        }
        asort($positions);
        return array_shift($positions);
    }
}