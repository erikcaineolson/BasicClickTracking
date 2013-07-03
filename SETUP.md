BasicClickTracking
==================

The script is particularly easy to use, with only one (1) required parameter and six (6) optional parameters. You may add or subtract more as you see fit.

First, the file is called "index.php" so that it can be inserted into a subdirectory and called without "php" in the URL (particularly helpful for email software that would "red flag" based on the use of a PHP script as a link). The file can be renamed anything without affecting its use (i.e., it is not self-referential).

*Customizing*
    1. You'll need to set the tracking text file directory. A search-and-replace for TRACKING_FILE_DIRECTORY will set your directory.

    2. You'll need to set values for your redirect URIs. These are set beginning on line 39 in the $redir array. You will need to provide "alias" values as well as the URIs (this prevents you from having to pass an entire URI as a parameter).
    
    3. If you want to append the optional parameters to your redirect URL, I recommend you do so in the header() function call (or preset a variable). This will result in cleaner code (and a smaller file). 
    Ex: header('Location: ' . $redir[$_REQUEST['r']] . ' ?a=' . $params['a'] . '&s1=' . $params['s1'];
    

*Gotchas*
    1. Make sure the script has permission to write to the log directory _before_ running the script. 
    
    2. The script should _not_ die out on a directory error...instead, it will do a redirect and never complain (if your logs seem lean, this might be why...check it).
    
    3. The reason for #2 is we never want to show a user something that doesn't work.
