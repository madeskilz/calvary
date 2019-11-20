<?php

if(! defined('ENVIRONMENT') )
{
    $domain = strtolower($_SERVER['HTTP_HOST']);

    switch($domain) {
        case 'portal.calvarypoly.edu.ng' :
        case 'www.portal.calvarypoly.edu.ng':
            define('ENVIRONMENT', 'production');
            break;
        default :
            define('ENVIRONMENT', 'development');
            break;
    }
}