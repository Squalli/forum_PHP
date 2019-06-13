<?php
	abstract class Entity {

    protected function hydrate($class, $data) {

        foreach ($data as $champ => $valeur) {

            //je pars avec le champ "modele"
            $prop = explode("_", $champ);

            //j'obtiens un tableau : ["modele", "marque", "prix", "etc"] et les valeurs des champs
            $method = "set" . ucfirst($prop[0]);

            //j'obtiens "setModele"
            if(method_exists($class, $method)) {
                //si la méthode setModele existe dans l'objet à instancier
                $this->$method($valeur);
                //je l'appelle
            }
        }
    }

}