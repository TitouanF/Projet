<?

//email.php @ application/config
defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| EMAIL CONFIGURATION
| -------------------------------------------------------------------
| 
*/
$config['useragent']    = 'CodeIgniter';
$config['protocol']     = 'smtp';
$config['smtp_host']    = 'ssl://smtp.gmail.com';
$config['smtp_user']    = 'codeignititouan@gmail.com'; 
$config['smtp_pass']    = 'Titouan007'; 
$config['smtp_port']	= '465';
$config['wordwrap']     = TRUE;    
$config['wrapchars']    = 76;
$config['mailtype']     = 'text';
$config['charset']      = 'utf-8';
$config['validate']     = FALSE;
$config['priority']     = 3;
$config['newline']      = "\r\n";
$config['crlf']         = "\r\n";
