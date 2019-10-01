<?php
include "page.php";

class content implements IContent
{

    function get_title1()
    {
        return "ОСНОВНОЙ ЗАГОЛОВОК";
    }

    function get_title2()
    {
        return "Подзаголовок";
    }

    function show_content()
    {
        print "Содержание главной страницы сайта";
    }
}

$p = new page(new content());
echo "test";