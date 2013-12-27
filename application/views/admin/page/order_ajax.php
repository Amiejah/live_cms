<?php
    $sortable = true;

    echo get_ol( $pages );

    function get_ol( $array, $child = FALSE ){
        $str = '';

        if( count( $array ) ){
            $str .= $child == FALSE ? '<ol class="sortable">' : '<ol class="child">';

            foreach( $array as $item ){
                $str .= '<li id="list_' . $item['id'] . '">';
                    $str .= '<div><span class="disclose"><span></span></span>' . $item['title'] . '</div>';


                // Check for children
                if( isset( $item['children'] ) && count( $item[ 'children' ] ) ){
                    $str .= get_ol( $item['children'], true );
                }

                $str .= '</li>';
            }


            $str .= '</ol>';

        }

        return $str;
    }
?>