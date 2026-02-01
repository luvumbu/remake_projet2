<?php
class EmailValidator {
    private $email;

    public function __construct($email) {
        $this->email = $email;
    }

    // Méthode pour valider l'adresse e-mail
    public function validate() {
        // Utilisation de filter_var pour valider l'email
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            // Vérification que l'adresse contient un point après le "@"
            return strpos($this->email, '.') !== false;
        }
        return false;
    }
}


/*
            // Exemple d'utilisation
            $emailInput = "example@example.com";
            $emailValidator = new EmailValidator($emailInput);

            if ($emailValidator->validate()) {
                echo "L'adresse e-mail est valide.";
            } else {
                echo "L'adresse e-mail est invalide.";
            }
    
*/
?>
