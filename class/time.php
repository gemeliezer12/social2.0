<?php
class Time{
    public function timeAgo($timestamp){
        $timeAgo = time() - $timestamp;
        if($timeAgo >= 60 * 60 * 24){
            $month = date("M", $timestamp);
            $day = date("d", $timestamp);
            $year = date("Y", $timestamp);
            $date = $month." ".$day;
            return $date;
        }
        elseif($timeAgo >= 60 * 60){
            $timeAgo = floor($timeAgo / 60 / 60);
            return $timeAgo."h"; 
        }
        elseif($timeAgo >= 60){
            $timeAgo = floor($timeAgo / 60);
            return $timeAgo."m"; 
        }
        else{
            return $timeAgo."s";
        }
    }

    public function hour($timestamp){
        $hour = date("H", $timestamp);
        $apm = "AM";
        if($hour > 12){
            $apm = "PM";
        }
        $time = date("h:i", $timestamp)." ".$apm;
        return $time;
    }
    
    public function date($timestamp){
        $monthNum = date("m", $timestamp);
        $month = date('F', mktime(0, 0, 0, $monthNum, 10));
        $day = date("d", $timestamp);
        $year = date("Y", $timestamp);
        $date = $month." ".$day.", ".$year;

        return $date;
    }
}