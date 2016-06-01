<?php

/*
地相基準時刻 2016/6/23 3:12:08 (いて座Aスターへの最接近時刻)
月相基準時刻 2016/3/9 0:24:00 (皆既月食)
地球公転周期 365.2421904 日	
月公転周期	27.321662 日

月相：
{ (now - 月相基準時刻) / 月公転周期 - (now - 月相基準時刻) / 地球公転周期 } の小数点以下
地相：
{ (now - 地相基準時刻) / 地球公転周期 } の小数点以下
 */

class lunarEarthPhase {
    public $lunarPase, $earthPhase;
    public function __construct ($data, $date="") {
        if ( !$date ) {
            $date = time(); // now
        }
        $lunarPhaseBase = strtotime($data["lunarPhaseBase"]);
        $lunarPos = ($date - $lunarPhaseBase)/($data["lunarRevPeriod"]*86400) - ($date - $lunarPhaseBase)/($data["earthRevPeriod"]*86400);
        $this->lunarPhase = ($lunarPos - floor($lunarPos));
        $earthPhaseBase = strtotime($data["earthPhaseBase"]);
        $earthPos = ($date - $earthPhaseBase)/($data["earthRevPeriod"]*86400);
        $this->earthPhase = ($earthPos - floor($earthPos));
    }
    public function noise_bg_url ($data) {
        $day = floor(28*$this->lunarPhase);
        $season = floor(24*$this->earthPhase) + 6;
        if ($season >= 24) $season -= 24;
        $url = "step=".$data["sst"][$day]["step"];
        $url .= "&scale=".$data["sst"][$day]["scale"];
        $url .= "&trans=".$data["sst"][$day]["trans"];
        $url .= "&colorq=".$data["hueQSat"][$season]["q"];
        $url .= "&colorqn=".$data["hueQSat"][$season]["qn"];
        $url .= "&colorh=".$data["hueQSat"][$season]["hue"];
        $url .= "&sat=".$data["hueQSat"][$season]["sat"];
        return $url;
    }
}

?>
