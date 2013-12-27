<?php

class MY_Session extends CI_Session {
    function sess_update() {
        // Listen tot the http_x_requested_with
        if ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] !== 'XMLHttpRequest') {
            parent::sess_update();
        }
    }
}