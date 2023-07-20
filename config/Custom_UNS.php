<?php
use Carbon\Carbon;
Carbon::setLocale('id');

return [
    'now' => Carbon::now(),
    'today' => Carbon::today(),
    'yesterday' =>Carbon::yesterday()
];
?>