<?php

$config['site']['base_url'] = 'http://localhost/';

$config['mongo']['hostbase'] = 'localhost:27017';
$config['mongo']['database'] = 'mccm';
$config['mongo']['username'] = '';
$config['mongo']['password'] = '';
$config['mongo']['persist']  = TRUE;
$config['mongo']['persist_key']	 = 'ci_persist';
$config['mongo']['replica_set']  = FALSE;
$config['mongo']['query_safety'] = 'safe';
$config['mongo']['suppress_connect_error'] = TRUE;
$config['mongo']['host_db_flag']   = FALSE;