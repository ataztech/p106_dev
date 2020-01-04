<?php

    function dateInWord($date){
        $dt = \Carbon\Carbon::parse($date)->format('dmY');
        if(\Carbon\Carbon::now()->format('dmY') == $dt){
            $d = 'Today';
        }elseif (\Carbon\Carbon::now()->subDay()->format('dmY') == $dt){
            $d = 'Yesterday';
        }else{
            $d = \Carbon\Carbon::parse($date)->format('d/m/Y');
        }
        return $d;
    }
