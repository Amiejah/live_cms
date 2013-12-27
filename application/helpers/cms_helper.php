<?php
function btn_edit( $uri ){
    return anchor( $uri, 'edit' );
}
function btn_delete( $uri ){
    return anchor( $uri, 'remove', array( 'onclick' => "return confirm('You are about to delete a user. This cannot be undone');" ) );
}

function create_image( $imagename, $height = NULL, $width = NULL, $alt = '', $title = '' ){
    // Create image url
    $img = '<img';
    $img .= ' src="'. create_url() . $imagename . '"';
    if(!empty($height)) {
        $img .= ' height="' . $height . '"';
    }
    if(!empty($width)) {
        $img .= ' width="' . $width . '"';
    }
    if(!empty($alt)) {
        $img .= ' alt="' . $alt . '"';
    }
    if(!empty($title)) {
        $img .= ' title="' . $title . '"';
    }

    $img .= '/>';
    return $img;
}

/**
 * Create the default url first
 */
function create_url() {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/images/';
    return $url;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function e( $string ){
    return htmlentities( $string );
}

function get_menu( $array, $child = FALSE ){

    $CI =& get_instance();

    $str = '';
    $i = 0;
    if( count( $array ) ){
        $str .= $child == FALSE ? '<ul class="nav navbar-nav">' : '<ul class="dropdown-menu">';

        foreach( $array as $item ){

            $active = $CI->uri->segment(1) == $item['slug'] ? true : false;

            if( isset( $item[ 'children' ] ) && count( $item[ 'children' ] ) ) {
                $str .= $active ? '<li class="dropdown active">' : '<li>';

                $str .= '<a class="dropdown-toggle" data-toggle="dropdown" href="' . site_url( $item[ 'slug' ]) . '">';
                $str .= '<span>' . $item[ 'title' ] . '</span>';
                $str .= '</a>';

                $str .= get_menu( $item[ 'children' ], true );
            } else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url( $item[ 'slug' ]) . '">';
                if($i == 0) {
                    $str .= '<i class="fa fa-home"></i>';
                }
                $str .= '<span>' . $item[ 'title' ] . '</span>';
                $str .= '</a>';

            }

            $str .= '</li>';
            $i++;
        }


        $str .= '</ul>';

    }

    return $str;
}
// Create the article links
function article_link( $article ){
    return 'article/' . intval($article->id) . '/' .  e( $article->slug );
}
// Create the widget link @TODO We have to of the same fnction here
function widget_link( $widgetName = 'widget', $widget ) {
    return $widgetName . '/' . intval($widget->widget_id) . '/' . e($widget->widget_slug);
}

// Simple search widget
function search_widget( $search = '', $widgetName = 'top_widget'){
    $search .= '<div class="widget ' . $widgetName . '">';
        $search .= '<h2>Search</h2>';
        $search .= form_open('search');
            $search .= '<div class="input-group">';
                $search .= form_input('search', '', 'class="form-control"');
                $search .= '<span class="input-group-btn">';
                    $search .= '<button class="btn btn-default" type="button">Search</button>';
                $search .= '</span>';
            $search .= '</div>';
        $search .= form_close();
    $search .= '</div>';
    return $search;
}
// Simple latest article widgets
function article_links( $articles, $widgetName = 'top_widget', $str = ''){
    $str .= '<div class="widget ' . $widgetName . '">';
        $str .= '<h2>Recent News</h2>';
        $str .= '<ul>';
            foreach( $articles as $article ){
                // Build the url
                $url = article_link( $article );
                $str .= '<li>';
                $str .= '<h3>' . anchor( $url, e( $article->title ) ) . '</h3>';
                $str .= '<p class="pubdate">' . $article->pub_date . '</p>';
                $str .= '</li>';
            }
        $str .= '</ul>';
    $str .= '</div>';
    return $str;
}

// Simple top-10 widgets
function get_top_widget( $widgetName = 'top_widget', $limit = 5, $widgetsData = array(), $widgetImage = true){

    $widget .= '<div class="widget ' . $widgetName . '">';
        $widget .= '<h2>Casino top 10</h2>';
        if(count($widgetsData)){
            $widget .= '<ul class="media-list">';
                foreach( $widgetsData as $widgetData ) {
                    // Build the url
                    $url = widget_link('casino', $widgetData);
                    $widget .= '<li class="media">';
                        if($widgetImage && !empty($widgetData->widget_image_upload)){
                            $widget .= '<span class="pull-left">';
                                $widget .= '<a href="' . $url . '" title="' . $widgetData->widget_title . '">';
                                    $widget .= '<img class="media-object img-responsive img-thumbnail" src="http://stickymatje.nl/images/' . $widgetData->widget_image_upload . '" alt="' . $widgetData->widget_title . '" title="' . $widgetData->widget_title . '"/>';
                                $widget .= '</a>';
                            $widget .= '</span>';
                        }
                        $widget .= '<div class="media-body">';
                            $widget .= anchor( $url, $widgetData->widget_title . '<em>Read more</em>' );
                        $widget .= '</div>';
                    $widget .= '</li>';
                }
            $widget .= '</ul>';
        } else {
            $widget .= 'Create a couple of casinos';
        }

    $widget .= '</div>';

    return $widget;
}

function get_excerpt( $article, $numwords = 50 ){
    $str = '';

    $url = article_link( $article );
    $str .= '<h2>' . anchor( $url, e( $article->title ) ) . '</h2>';
    $str .= '<p class="pubdate">' . e( $article->pub_date ) . '</p>';
    $str .= '<p>' . e( limit_to_numwords( strip_tags( $article->body ), $numwords ) ) . '</p>';
    $str .= '<p>' . anchor( $url, 'Read more > ', array( 'title' => e( $article->title )) ) . '</p>';

    return $str;
}

function limit_to_numwords( $string, $numwords){
    $excerpt = explode( ' ', $string, $numwords + 1 );
    if( count( $excerpt ) >= $numwords ){
        array_pop( $excerpt );
    }
    $excerpt = implode( ' ', $excerpt );
    return $excerpt;
}

function add_meta_title($string) {
    $CI =& get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}