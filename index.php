<?php

/**
 * 
 * @param String $address
 * @return array
 * @author Rafael Queiroz, (12) 98161-3370
 */
function GetEnvinroment($address = null)
{
    if(is_null($address))
    {
        $address = __DIR__;
    }
    else
    {
        $location   = __DIR__ . $address;
        $address    = $location;
    }
    echo $address;
    if(file_exists($address . '.env'))
    {
        $file = file('.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }

    $params = array();
    $values = array();

    foreach ($file as $lines => $line)
    {
        $size           = strlen($line);
        $has_hashtrag   = false;

        for($i = 0; $i < $size; $i ++)
        {
            if($line[$i] == "#") {
                $has_hashtrag = true;
            }
        }

        $line_break = explode('=', $line);

        if($has_hashtrag == false)
        {
            $params[$lines] = $line_break[0];        
            $results        = explode('"', $line_break[1]);
            $values[$lines] = $results[1];
        }  

        $has_hashtrag   = false;
        $line_break     = null;
    }

    $i      = count($params);
    $j      = count($values);
    $env    = array();

    if($i > $j || $i < $i) 
    {
        var_dump("Falha no arquivo .ENV local");
    }
    else
    {
        for($k = 0; $k <= $i; $k ++)
        {
            if(isset($params[$k]))
            {
                $env[$k]['parameter']   = $params[$k];
                $env[$k]['value']       = $values[$k];
            }
        }
    }

    return $env;
}

$env = GetEnvinroment('/setup/');
var_dump($env);