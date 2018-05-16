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
  * Nom de famille
  * Ville
  * Email
* Enfant :
  * ID
  * Prénom
  * date de naissance
  * Restriction alimentaire
  * Information général
* Nounou :
  * langue
    * ID clé étrangère
    * Langue
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
    * Nom
    * Prénom
    * Ville
    * Email
    * Portable
    * Liste des langues parlées
    * Une photo
    * Age
    * Expérience
    * Une phrase de présentation
    * Liste des évaluations effectuées par les parents
  * Evalution :
    * ID
    * Note 
    * Avis
  * salaire :
    * ID 
    * revenu
* bdd pour compte : 
  * Nounou
    * Users --> utilisé comme clé étrangère* mdp 
    * statut
  * Parent 
    * Users --> utilisé comme clé étrangère
    * mdp
    
## Sitemap

* index
  * nounou
    * connection + php pour la vérifier la connexion
    * creation + php pour vérifier la création
    * planning + php dans la page pour créer le calendrier avec les dates + AJAX pour les événements
    * creationplanning + formulaire --> ajouter des heures / retirer des heures ?
    * profil + php pour remplir tout le profil et enregistrer les nouvelles infos modifié
  * parent
    * connection + php pour la vérifier la connexion / si la connexion passe redirigé vers le calendrier
    * creation + php pour vérifier la création  / si création OK redirigé vers enregistrementprofil
    * enregistrementprofil : formulaire
    * profil + php pour remplir tout le profil et enregistrer les nouvelles infos modifié et nounou prisent
    * recherche
    * nounou + php pour mettre en forme dynamiquement le profil de la nounou
* a-propos
* contact
  
  














