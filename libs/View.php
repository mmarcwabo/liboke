<?php

class View
{
    function __construct()
    {
    }

    /**
     * render - Render a view
     */
    public function render($viewname, $content = false)
    {
        //Including the header
        require "views/header.php";
        //Including sidebar too
        //require "views/sidebar.php";
        //Including the page content
        require "views/" . $viewname . ".php";
        if ($content) {
            echo $content;
        }
        //Including the footer
        require "views/footer.php";
    }
}
