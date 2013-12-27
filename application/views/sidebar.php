
<?php
    // Widgets are located in the helpers/cms_helper.php

    // The search widget
    echo search_widget();

    // Latest articles
    echo article_links( $recent_news );
    //echo anchor( $news_archive_link, '+ News archive');

    // Top Casinos
    echo get_top_widget('', 5, $top_widget);
?>
