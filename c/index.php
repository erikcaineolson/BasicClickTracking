<?php
	/*******************************************************\
	|														|
	|	Basic click-tracking script. Writes to a text 		|
	|	file which you can later parse however you see		|
	|	fit. Takes up to 8 parameters: r, a, e, and s1-s5	|
	|	r is the only required parameter. See the README	|
	|	and SETUP for more information.						|
	|														|
	\*******************************************************/

    require_once('../classes/Logger.php');

    // variable declaration
    $delimiter = NULL;
	$fh = NULL;
	$filedir = NULL;
	$filename = NULL;
    $log_message = NULL;
	$params = NULL;
	$redir = NULL;
    $redirect_url = NULL;
    $tracking_log = NULL;
    $tracking_log_file = NULL;

    // set the path and file name for your tracking log
    $tracking_log = 'PATH/TO/TRACKING.LOG';

    // alter the delimiter to whatever you want breaking up sections
    // of the log (each record will be on its own line); suggestions
    // are commas (,), semi-colons (;), double-colons (::), and pipes (|)
    // default is a pipe (|)
    $delimiter = '|';

	$filedir = '/ABSOLUTE_TRACKING_FILE_DIRECTORY/';

    if(is_dir($filedir)){
    	isset($_SERVER['HTTP_REFERER']) ? $filename = $filedir . '/' . $_SERVER['HTTP_REFERER'] . '_' . date('Y-m-d') . '.txt' : $filename = $filedir . '/' . date('Y-m-d') . '.txt';
    }

    // set parameters; declare defaults where necessary and ensure clean values are passed
    // regex is against \W, a Perl "word" (alphanumeric characters + underscore)
    // if it's not a legit value, we replace it with an empty string ''
    isset($_REQUEST['r']) ? $params['r'] = preg_filter('/\W/', '', $_REQUEST['r']) : $params['r'] = 0;
	isset($_REQUEST['a']) ? $params['a'] = preg_filter('/\W/', '', $_REQUEST['a']) : $params['a'] = 100005;
	isset($_REQUEST['s1']) ? $params['s1'] = preg_filter('/\W/', '', $_REQUEST['s1']) : $params['s1'] = '';
	isset($_REQUEST['s2']) ? $params['s2'] = preg_filter('/\W/', '', $_REQUEST['s2']) : $params['s2'] = '';
	isset($_REQUEST['s3']) ? $params['s3'] = preg_filter('/\W/', '', $_REQUEST['s3']) : $params['s3'] = '';
	isset($_REQUEST['s4']) ? $params['s4'] = preg_filter('/\W/', '', $_REQUEST['s4']) : $params['s4'] = '';
	isset($_REQUEST['s5']) ? $params['s5'] = preg_filter('/\W/', '', $_REQUEST['s5']) : $params['s5'] = '';

    // replace 'URL_n' with your redirect URL's
    // add more by following the same pattern
    // where 'REDIRECT_x' = 'URL_x', and where
    // 'URL_x' = your new URL
    $redir = array('REDIRECT_1' => 'URL_1',
                   'REDIRECT_2' => 'URL_2',
                   'REDIRECT_3' => 'URL_3');

    // if you want to add to the redirect URL, do so here
    $redirect_url = $redir[$_REQUEST['r']];

    /**
     *                              *
     * DO NOT EDIT BELOW THIS LINE  *
     *                              *
     **/

    // ------------------------------ //
    if($filename != '' && is_file($filename)){
        $tracking_log = new Logger($filename, $delimeter);
    }else{
        $tracking_log = FALSE;
    }

    $log_message = array();

    foreach($params as $key => $value){
        $log_message[$key] = $value;
    }

    if($tracking_log !== FALSE){
        $tracking_log->LogAccess('', $log_message);
    }

    header('Location: ' . $redirect_url);
?>