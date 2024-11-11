<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Portal';
$route['translate_uri_dashes'] = FALSE;
$route['about-us'] = 'Portal/About';
$route['contact-us'] = 'Portal/Contact';
$route['login'] = 'Portal/Login';
$route['event'] = 'Portal/Event';
$route['register'] = 'Portal/Register';
$route['admin'] = 'Login';
$route['webinar'] = 'Portal/Webinar';
$route['privacy-policy'] = 'Portal/Privacy';
$route['terms-and-conditions'] = 'Portal/Terms';
$route['refund-policy'] = 'Portal/Refund';
//$route['course/(:num)'] = 'Portal/Course';
$route['start-test/(:num)'] = 'Portal/PlayTest';
$route['payment-pending'] = 'Portal/PaymentPending';
$route['forgot'] = 'Portal/ForgotPassword';