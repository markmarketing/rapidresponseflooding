<?php

final class Config
{

    /**
     * 	stores all the config info for all environment settings
     * 
     * 	@param	$env		string		- the environment name either dev, staging, sandbox, or live ?
     * 	@return	$config		array		- returns the config info for the selected environment
     * 
     */
    public static function getInfo(string $env = 'dev'): array
    {
        if (!empty(self::getEnvironment())) $env = strtolower(self::getEnvironment());
        switch ($env) {
            case 'dev':
                return [
                    'username'     => 'rapidresponse_dev',
                    'password'    => 'npwd1409!',
                    'server'    => 'localhost',
                    'schema'    => 'rapidresponse_dev',
                ];
                break;
            case 'staging':
                return [
                    'username'     => 'root',
                    'password'    => 'fassy888',
                    'server'    => 'localhost',
                    'schema'    => 'Account',
                ];
                break;
            case 'prod':
                return [
                    'username'     => 'rapidresponse',
                    'password'    => 'rapid13e5P',
                    'server'    => 'localhost',
                    'schema'    => 'rapidresponse',
                ];
                break;
            default:
                return [
                    'username'     => 'rapidresponse',
                    'password'    => 'rapid13e5P',
                    'server'    => 'localhost',
                    'schema'    => 'rapidresponse',
                ];
                break;
        }
    }

    /**
     * 	@return  string 	$env 	-the environment var
     * 
     */
    public static function getEnvironment()
    {
        // return getenv('SERVER');
        $parts = explode('.', $_SERVER['HTTP_HOST']);
        
        $dev_array = ['dev', 'dev2'];
        $prod_array = ['prod', 'www'];

        // return dev environment
        if (in_array($parts[0], $dev_array)) return "dev";
        // return prod environment
        if (in_array($parts[0], $prod_array)) return "prod";
    }
}
