<?php
if(isset($token)){
    echo
            '<button onclick="window.print()" class="nav-item active float-right ">
                <span id="'.$GLOBALS['PROJECT_DIR'].$token.'" hidden></span>
                <img src="'.$GLOBALS['PROJECT_DIR'].'/images/printer.png" width="100px" height="90px">
            </button>'
        ;
    }

