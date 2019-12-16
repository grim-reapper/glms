<?php
// Start the session if it was not already started
if(session_id() == '') {
    
    session_id();
    session_start(); // Start Session
    
    if ( ! headers_sent() ) {
        header('Cache-control: private'); // IE 6 FIX
    }
}
?>