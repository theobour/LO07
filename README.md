# LO07
Projet LO07 Nounou

## Sommaire
1. [Objectifs](#Objectifs)
1. [Fonctionnalité Admin](#fonctionnalité--admin]
1. [Fonctionnalité Nounou](#fonctionnalité--nounou]
1. [Fonctionnalité Parent](#fonctionnalité--parent]
1. [Base de donnée](#base-de-donnée-)

## Objectifs

L'objectif de ce projet est de concevoir, de développer et de tester un site Web dynamique pour la mise en
relation de nounous avec des parents.

1. Votre site doit permettre la mise en relation de nounous et de parents. Les parents choisissent les nounous
en fonction de plusieurs critères (disponibilité, compétences, évaluations réalisées par les autres parents, …) . 
1. Les visiteurs peuvent accéder à des informations générales présentant votre entreprise. Pour utiliser les
services proposés, les visiteurs doivent disposer d’un compte (login + mot de passe) . 
1. Il y a trois types d’utilisateurs : les nounous, les parents, l’administrateur du site . 
1. Pour simplifier la mise en relation, nous utiliserons la ville comme adresse pour les nounous et les parents . 

## Fonctionnalité : Admin

Information sur le site :
* Récupérer le nombre de candidature, nombre de nounous inscrites : page php permettant de faire le total du nombre de nounou ainsi que de candidate sur une période donnée (ajouter dans la table nounou la data d'inscription)
* Chiffre d'affaire du site : il faudra stocker quelque part l'argent qui transite par le site selon les prix
* Liste décroissante des revenus par nounou : stocker quelque part l'argent que récolte la nounou
Recrutement des nounous :
* Il peut accepter les nounous qui candidates : bdd dédiée aux nounous qui candidates. Du côté front-end une page simple avec le nombre de nounous et dans la nav un onglet avec le nombre de candidature en attente. Privilégié une nav latérale présent sur les gros site de collect de data (google analytics, saleforce)
* L'admin peut bloquer une nounou temporairement : même bdd que les nounous qui candidatent mais un statut différent ? (Candidate/ bloqué) ?

## Fonctionnalité : nounou

....

* Fonctionnalité de création de compte pour une nounou, d'abord création de compte puis elle renseigne s'est informations pour envoyer sa candidature
* Calendrier de nounou : définir une dispo simple ou  récurrente entre deux dates. Nouvelle bdd avec les différentes reservation par nounou ?
  * Permettre aux nounous de savoir quand elle taff et quand elle ne taff pas (rouge/vert)
  * Ce planning doit comprendre la modalité( langue, nb de gosse, où etc). (les parents doivent donc définir ça en reservant ? Possiblité de transmettre ces informations direct en les enregistrant côté parents ?)

## Fonctionnalité : parent

## Base de donnée :

* Parent :
  * ID
  * nom
  * ville
  * email
* Enfant :
  * ID
  * prenom
  * date
  * alimentation
  * info
* Nounou :
  * langue
    * ID clé étrangère
    * langue
  * planning créneau réservé
    * ID clé étrangère
    * heure/date début
    * nb de créneau de 30min
    * Ponctuel régulière étrangère
    * Information enfant
  * Planning dispo
    * ID
    * jour en anglais ou date si non renouvelable
    * heure de début
    * Type de prestation
    * nbTps
    * // Tache cron qui supprime les dates passé chaque semaine
  * Info nounou
    * ID
    * nom
    * prenom
    * ville
    * email
    * portable
    * langue
    * photo
    * age
    * expérience
    * presentation
  * Evalution :
    * ID
    * Note 
    * Avis
  * salaire :
    * ID 
    * revenu
* bdd pour compte : 
  * Nounou
    * users --> utilisé comme clé étrangère
    * mdp 
    * statut
  * Parent 
    * users --> utilisé comme clé étrangère
    * mdp
    
## Sitemap

* index
  * nounou
    * creation + php pour vérifier la création
       * enregistrement-profil : formulaire --> redirection merci.php
       * merci.php
    * connection + php pour la vérifier la connexion --> planning (err si personne se connexte en étant candidate)
      * planning + requete AJAX vers planning.php pour récupérer calendrier + horaires
      * planning.php
      * profil + php pour remplir tout le profil et enregistrer les nouvelles infos modifié
      * creation-planning + formulaire --> ajouter des heures (bonus : retirer des heures)
      * implementation-planning.php
  * parent
    * creation + php pour vérifier la création  / si création OK redirigé vers enregistrement-profil
      * enregistrement-profil : formulaire --> redirection connexion
    * connection + php pour la vérifier la connexion --> recherche
      * recherche
      * profil + php pour remplir tout le profil et enregistrer les nouvelles infos modifié et nounou prisent
      * validation-horaire + modal au clique de validation : laisser un avis/commentaire(horaire effcetive permet incrémentation salaire)
* a-propos
* contact

## Base de donnée réelle :

* Nounou ; table :
  * connexion
    * ID : int : clé primaire
    * nomdecompte : varchar(50)
    * mdp : text
    * statut : varchar(50) -> Candidate / Bloquée / Nounou
  * info 
    * ID : varchar(255) --> correspondt nomdecompte de la table connexion
    * nom : varchar(255)
    * prenom : varchar(255)
    * email : varchar(255)
    * sexe : varchar(15)
    * age : int
    * nblangue : int
    * ville : varchar(255)
    * portable : int
    * presentation : text
    * experience : text
    
    
## TODO : (X = effectué)
 * CSS 
 * Mise en place du planning nounou
 * Mise en place de la recherche pour les parents 
 * Si une nounou n'est pas en statut "Nounou" elle ne peut pas accéder à ses pages
 * Mise en place côté administrateur
 * Profil parent : l'ensemble des enfants ne sont pas mis sur le profil
 * Compléter la page profil pour permettre la modification des informations
 * Js pour l'inscription pour permettre à la nounou de rentrer plusieurs langue
 * Création d'un token unique pour le suivi de session. Si nomdecompte ou ID on peut avoir pour la nounou et les parents le même : https://openclassrooms.com/forum/sujet/creation-d-un-systeme-de-token-1














