<?php
if(!function_exists('getFileSize')){
    /**
     *  Concatenate a set of array values as a path glued with slashes (separator).
     *  
     *  @param string $file_path The full path to the file. Can be local or remote (HTTP(S))
     *  @return int Returns the size of the file in bytes. Warning: it may return Boolean FALSE, but may also return a non-Boolean value which evaluates to FALSE.
     *  
     *  @details A helper function to get the size of file whether it be local or remote.
     *  
     *  @author Ash Bulcroft <ashbulcroft@gmail.com>
     */
    function getFileSize($file_path) {
        
        if(substr($file_path, 0, 4) == 'http'){
            $result = array_change_key_case(get_headers($file_path, 1), CASE_LOWER);
            
            //not all headers return with the full "HTTP/1.1 200 OK" status, so we look for it without the "OK" part.
            $file_ok = false; 
            if(strncmp($result[0], 'HTTP/1.1 200 ', 13) === 0){
                $file_ok = true;
            }
            
            $result = ($file_ok === true ? (!empty($result['content-length']) ? $result['content-length'] : 0) : false);
        }
        else{ 
            $result = @filesize($file_path);
        }
        
        return $result;
    }
}
