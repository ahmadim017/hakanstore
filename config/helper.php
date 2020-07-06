<?php

function setActive($path)
{
    return Request::is($path . '*') ? 'active' : '';
}

function money_id($str)
{
    return 'Rp.' .number_format($str, '0', '', '.');
}

function TanggalID($format, $tanggal="now", $bahasa="id")
{
    $en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

    $id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");

    return Str::replaceArray($en,$bahasa,date($format,strtotime($tanggal)));
}