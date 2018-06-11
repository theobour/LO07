# LO07

## Sitemap avec utilité des pages (// = ne pas relier)
 * adminsys
   * gestion-nounou.php : permet de bloquer/accepter les nounous
   * gestion-salaire.php : permet d'afficher les salaires et le nombre d'heure
 * nounou
   * //calendarweek.php : permet de générer le calendrier
   * //creation-planning-semaine.php : permet de récupérer les infos sur les dates pour les envoyer à calendarweek.php
   * planning.php : permet d'avoir le planning avec les reservations et les créneaux de libre + formulaire pour ajouter des horaires de créneau de libre
   * profil.php : afficher le profil de la nounou
   * //redirection-erreur.php : permet de rediriger si la nounou est bloqué ou candidate
 * parent 
   * apres-reservation.php : permet de valider, noter et mettre un avis sur une reservation
   * profil.php : permet de consulter son profil
   * //profil-nounou.php : génère le profil de la nounou recherché
   * recherche-nounou.php : permet d'accéder à la recherche des nounous
   * //validation.php : permet d'insérer dans la bdd les informations de après-reservation 
 * generique-file
   * //ajout-horaire.php : permet d'insérer dans la bdd les informations d'ajout d'horaire de libre et de reservation venant de planning.php(nounou) et profil-nounoun.php(parent)

## Bases de données
 * generique
   * connexion
     * ID : int primary_key
     * nomdecompte : varchar(255)
     * mdp : text
     * email : varchar(255)
     * statut : varchar(255)
 * nounou
   * avis
     * ID : varchar(255)
     * note : int
     * avis : text
     * parent : varchar(255)
   * info
     * ID : varchar(255)
     * nom : varchar(255)
     * prenom : varchar(255)
     * email : varchar(255)
     * sexe : varchar(15)
     * age : int
     * nblangue : int
     * ville : varchar(255)
     * portable : int
     * photo : varchar(255)
     * presentation : text
     * experience : text
   * langue
     * ID : varchar(255)
     * langue : varchar(255)
   * planning 
     * ID : varchar(255)
     * date : varchar(255)
     * heure : varchar(255)
     * statut : varchar(255)
     * prix : int
     * client : varchar(255)
   * salaire 
     * ID : varchar(255)
     * salaire : int
     * nbheure : int
 * parent
   * enfant 
     * ID : varchar(255)
     * prenom : varchar(255)
     * age : int
     * information : text
   * info
     * ID : varchar(255)
     * nom : varchar(255)
     * email : varchar(255)
     * telephone : int
     * ville : varchar(255)
     * enfant : int 
     * information : text










