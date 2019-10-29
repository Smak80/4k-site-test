<?php
abstract class Content{
    protected $user_data = [];
    abstract function get_title1();
    abstract function get_title2();
    abstract function show_content();
    function get_user_data(){
        foreach ($_REQUEST as $k=>$v){
            $this->user_data[$k] = htmlentities($v, ENT_QUOTES, "UTF-8");
        }
    }
}

class page
{
    private $content;
    public function __construct($content)
    {
        if ($content instanceof Content) {
            $this->content = $content;
            $this->content->get_user_data();
            $this->show_page();
        }
    }

    private function show_page(){
        $this->content->get_user_data();
        $this->show_head();
        $this->show_menu();
        $this->show_content();
        $this->show_footer();
    }

    private function show_head(){
        ?>
        <!doctype html>
        <html lang="ru">
        <head>
            <link rel="stylesheet" type="text/css" href="main.css">
            <title><?print $this->content->get_title1();?></title>
        </head>
        <body>
        <div class="container"><h1 style="text-align: center;"><?
                print $this->content->get_title1();
                ?></h1></div>
        <div class="container"><h3 style="text-align: center;"><?
                print $this->content->get_title2();
                ?></h3></div>
        <?php
    }
    private function show_menu(){
        ?>
        <div class="container" style="display: flex;">
            <div><a href="index.php">Первая страница</a></div>
            <div><a href="second.php">Вторая страница</a></div>
            <div>Пункт меню 3</div>
            <div>Пункт меню 4</div>
        </div>
        <?
    }

    private function show_content(){
        print '<div class="main">';
        $this->content->show_content();
        print '</div>';
    }

    private function show_footer(){
        print "<div class='container'>© Sergey Makletsov, 2019</div>";
        print "</body></html>";
    }
}