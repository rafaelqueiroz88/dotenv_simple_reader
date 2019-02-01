<?php

/**
 * Get .env file from root folder and return array
 * @param String $address
 * @return array
 * @author Rafael Queiroz, (12) 98161-3370
 */
class Environment_Manager
{

    public function __construct($address = null)
    {

        if(file_exists('.env'))
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

        $this->SetEnvironment($env);
    }

    /**
     * Load Environments from .env
     */
    private function SetEnvironment($env)
    {
        
        $j      = count($env);
        
        for($i = 0; $i < $j; $i ++)
        {
            if(!isset($env[$i]['parameter']))
            {
                $j ++;
            }
            else 
            {
                $str = $env[$i]['parameter'] .'='. $env[$i]['value'];
                putenv("$str");
            }
        }
    }
}