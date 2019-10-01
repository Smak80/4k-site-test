<?php
interface IContent{
    function get_title1();
    function get_title2();
    function show_content();
}

class page
{
    private $title1;
    private $title2;
    private $content;
    public function __construct($content)
    {
        $this->title1 = $content->get_title1();
        $this->title2 = $content->get_title2();
        $this->content = $content;
        $this->show_page();
    }

    private function show_page(){
        $this->show_head();
        $this->show_menu();
        $this->show_content();
        $this->show_footer();
    }

    private function show_head(){
        print <<< HEADER
<!doctype html>
<html>
<head>
<title>{$this->title1}</title>
</head><body>
<div class="title">{$this->title1}</div>
<div class="subtitle">{$this->title2}</div>
HEADER;

    }
    private function show_menu(){

    }

    private function show_content(){
        $this->content->show_content();
    }

    private function show_footer(){
        print "</body></html>";
    }
}