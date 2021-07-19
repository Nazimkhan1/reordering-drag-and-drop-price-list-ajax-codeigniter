<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['facebook_app_id']              = '973988843364787';
$config['facebook_app_secret']          = '5a688648d1d91ab32aab898043761ddc';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'facebook_login';
$config['facebook_logout_redirect_url'] = 'facebook_login/logout';
$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v2.6';
$config['facebook_auth_on_load']        = TRUE;
