<?php

//文字列をエスケープするための関数
function h($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
