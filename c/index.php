<?php
	/*******************************************************\
	|														|
	|	Basic click-tracking script. Writes to a text 		|
	|	file which you can later parse however you see		|
	|	fit. Takes up to 8 parameters: r, a, e, and s1-s5	|
	|	r is the only required parameter. See the README	|
	|	for more information.								|
	|														|
	\*******************************************************/

	$fh = NULL;
	$filedir = NULL;
	$filename = NULL;
	$logstr = NULL;
	$params = NULL;
	$redir = NULL;

	$filedir = 'TRACKING_FILE_DIRECTORY';

	isset($_SERVER['HTTP_REFERER']) ? $filename = $_SERVER['HTTP_REFERER'] . '_' . date('Y-m-d') . '.txt' : $filename = date('Y-m-d') . '.txt';

	isset($_REQUEST['a']) ? $params['a'] = $_REQUEST['a'] : $params['a'] = 100005;
	isset($_REQUEST['e']) ? $params['e'] = $_REQUEST['e'] : $params['e'] = '';
	isset($_REQUEST['s1']) ? $params['s1'] = $_REQUEST['s1'] : $params['s1'] = '';
	isset($_REQUEST['s2']) ? $params['s2'] = $_REQUEST['s2'] : $params['s2'] = '';
	isset($_REQUEST['s3']) ? $params['s3'] = $_REQUEST['s3'] : $params['s3'] = '';
	isset($_REQUEST['s4']) ? $params['s4'] = $_REQUEST['s4'] : $params['s4'] = '';
	isset($_REQUEST['s5']) ? $params['s5'] = $_REQUEST['s5'] : $params['s5'] = '';

	if(is_dir($filedir)){
		$logstr = date('Y-m-d H:i:s') . '|' . $_SERVER['REMOTE_ADDR'] . '|' . $params['e'] . '|' . $params['a'] . '|' . $params['s1'] . '|' . $params['s2'] . '|' . $params['s3'] . '|' . $params['s4'] . '|' . $params['s5'] . '|' . $params['r'] . "\n";

		$fh = fopen($filedir . $filename, 'a');
		fwrite($fh, $logstr);
		fclose($fh);
	}

			$redir = array('REDIRECT_1' => 'URL_1',
						   'REDIRECT_2' => 'URL_2');

	header('Location: ' . $redir[$_REQUEST['r']]);
?>