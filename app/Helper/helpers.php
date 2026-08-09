<?php

use Illuminate\Support\Facades\Crypt;

function dropdownMenuContainer($elements)
{
    $html = '<div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i></button>
            <div class="dropdown-menu" role="menu" style="">';
    $html .= $elements;
    $html .= '</div></div>';
    return $html;
}

function encrypt_value($encriptValue)
{
    return Crypt::encrypt($encriptValue);
}
function decrypt_value($decriptValue)
{
    return Crypt::decrypt($decriptValue);
}
