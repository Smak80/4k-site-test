<?php

require_once "page.php";

class second extends Content{

    public function get_title1()
    {
        return 'ОСНОВНОЙ ЗАГОЛОВОК ВТОРОЙ СТРАНИЦЫ';
    }

    public function get_title2()
    {
        return 'Подзаголовок второй страницы';
    }

    function show_content()
    {
        print 'Содержание второй страницы сайта';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        print '<br>';
        print 'Здесь выводим что-то еще...';
        $ud = $this->user_data['someval'];
        ?>
        <form action="second.php" method="post">
            <input type="text" name="someval" value="<?print $ud;?>" placeholder="Введите что-нибудь">
            <input type="submit" value="отправить">
        </form>
        <?
        if (isset($ud)) {
            print "<div>Пользователь написал: $ud;</div>";
        }

    }
}

new page(new second());