<?php 

class Get_anne_2
{
    public $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function get_temps_restant()
    {
        date_default_timezone_set('Europe/Paris');
        $date_cible = strtotime($this->name);
        $date_actuelle = time();

        $difference = $date_cible - $date_actuelle;

        $annees = floor(abs($difference) / (3600 * 24 * 365));
        $jours = floor((abs($difference) % (3600 * 24 * 365)) / (3600 * 24));
        $heures = floor((abs($difference) % (3600 * 24)) / 3600);
        $minutes = floor((abs($difference) % 3600) / 60);
        $secondes = abs($difference) % 60;

        return [
            "annees" => $annees,
            "jours" => $jours,
            "heures" => $heures,
            "minutes" => $minutes,
            "secondes" => $secondes,
            "is_past" => $difference < 0
        ];
    }
}



?>