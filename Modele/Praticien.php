<?php

require_once 'Framework/Modele.php';

// Services métier liés aux praticiens
class Praticien extends Modele {

    // Morceau de requête SQL incluant les champs de la table praticien
    private $sqlPraticien = 'select id_praticien as idPraticien, nom_praticien as nomPraticien, prenom_praticien as prenomPraticien, adresse_praticien as adressePraticien, cp_praticien as cpPraticien, ville_praticien as villePraticien, coef_notoriete as coefNotoriete, P.id_type_praticien as idTypePraticien, TP.lib_type_praticien as libTypePraticien from PRATICIEN P join type_praticien TP on P.id_type_praticien=TP.id_type_praticien';

    // Renvoie la liste des praticiens
    public function getPraticiens() {
        $sql = $this->sqlPraticien . ' order by nom_praticien';
        $praticiens = $this->executerRequete($sql);
        return $praticiens;
    }

    // Renvoie un praticien à partir de son identifiant
    public function getPraticien($idPraticien) {
        $sql = $this->sqlPraticien . ' where id_praticien=?';
        $praticien = $this->executerRequete($sql, array($idPraticien));
        if ($praticien->rowCount() == 1)
            return $praticien->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun praticien ne correspond à l'identifiant '$idPraticien'");
    }

}
