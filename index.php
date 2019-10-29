<?php
require_once 'page.php';

class index extends Content
{

    public function get_title1()
    {
        return 'ОСНОВНОЙ ЗАГОЛОВОК';
    }

    public function get_title2()
    {
        return 'Подзаголовок';
    }

    public function show_form(){

    }

    public function show_content()
    {
        print 'Содержание главной страницы сайта';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        $this->show_form();
    }

    public function get_user_data()
    {
        if (isset($_REQUEST['n'])){

        }
    }
}

$p = new page(new index());