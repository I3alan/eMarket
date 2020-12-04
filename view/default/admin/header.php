<?php
/* =-=-=-= Copyright © 2018 eMarket =-=-=-=  
  |    GNU GENERAL PUBLIC LICENSE v.3.0    |
  |  https://github.com/musicman3/eMarket  |
  =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= */

if (isset($_SESSION['login']) && isset($_SESSION['pass'])) { // Выводим если авторизованы 

    ?>

    <nav class="navbar navbar-fixed-top navbar-inverse">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-navbar">
                <!-- 1 УРОВЕНЬ МЕНЮ -->
                <ul class="nav navbar-nav">
                    <?php
                    for ($i = 0; $i < count($level); $i++) {
                        // Параметры для меню с подуровнями
                        $param_1 = 'class="dropdown-toggle" data-toggle="dropdown"';
                        $param_2 = '<b class="caret"></b>';
                        // если нет подуровней,то не отображаем их
                        if ($level[$i][2] == 'false') {
                            $param_1 = '';
                            $param_2 = '';
                        }

                        ?>
                    
                        <li>
                            <!-- выводим данные 1 уровня меню -->
                            <a href="<?php echo $level[$i][0] ?>" <?php echo $param_1 ?>><?php echo $level[$i][1] . $param_2 ?></a>
                            <?php if (isset($menu[$i])) { ?>
                                <!-- 2 УРОВЕНЬ МЕНЮ -->
                                <ul class="dropdown-menu">
                                    <?php
                                    for ($x = 0; $x < count($menu[$i]); $x++) {
                                        // если нет подуровней,то не отображаем их
                                        if ($menu[$i][$x][4] == 'false') {
                                            $param_1 = '';
                                            $param_2 = '';
                                        }

                                        ?>
                                    
                                        <li>
                                            <!-- выводим данные 2 уровня меню -->
                                            <a <?php echo $menu[$i][$x][3]; ?> href="<?php echo $menu[$i][$x][0] ?>" <?php echo $param_1 ?>><span class="<?php echo $menu[$i][$x][1]; ?>"></span> <?php echo $menu[$i][$x][2] . ' ' . $param_2 ?></a>
                                            <?php if (isset($submenu[$i][$x])) { ?>
                                                <!-- 3 УРОВЕНЬ МЕНЮ -->
                                                <ul class="dropdown-menu link">
                                                    <?php
                                                    for ($y = 0; $y < count($submenu[$i][$x]); $y++) {

                                                        ?>
                                                        <li>
                                                            <!-- выводим данные 3 уровня меню -->
                                                            <a <?php echo $submenu[$i][$x][$y][3]; ?> href="<?php echo $submenu[$i][$x][$y][0]; ?>"><span class="<?php echo $submenu[$i][$x][$y][1]; ?>"></span> <?php echo $submenu[$i][$x][$y][2]; ?> </a>
                                                        </li><?php } ?>
                                                </ul><?php } ?>
                                                
                                        </li><?php } ?>
                                        
                                </ul><?php } ?>
                                
                        </li><?php } ?>
                        
                </ul>
            </div>
        </div>
    </nav>

<?php } ?>