# FSA

Partie 1: Importation de la BDD



Tout d'abord rendez-vous dans phphmyadmin et créez/choisissez la base de donnée où se trouve votre site wordpress.

Un fichier BDD.sql est disponible sur le repositeroty FSA, celui-ci contient un script à importer via phpmyadmin à l'aide du bouton importer.

![image](https://user-images.githubusercontent.com/93580066/179734007-9eed91b7-db64-4ff4-8a02-34a48e78de9e.png)

Une fois cela fait les tables seront ajoutées à la BDD, notamment celles en raport avec wordpress (qui ont des préfixes wp_), seront ajoutées à la BDD si nous sommes dans le cas d'un installation de wordpress.

Si ce dernier est déjà installé alors il faudra supprimer les parties du script sql qui crée ces tables en wp_ pour éviter des messages d'erreurs dûes à des doublons.
(enlever les CREATE table `wp_...` et laisser les ALTER table `wp_...` )

Il faudra également spécifier les id de chaques tables comme étant des clés primaires et auto-increment afin de pouvoir modifier les tables importées

![image](https://user-images.githubusercontent.com/93580066/179734502-7f71fe4a-a533-4a43-b2c9-d75d1fe6a1f5.png)

Ici on ne peut pas faire de modifications car il y a des doublons pourr l'id (ne devraient pas etre le cas). Si cela arrivent il suffit de vider la table, de remplir avec les donnnées necessaire puis de modifier la structure de la table

![image](https://user-images.githubusercontent.com/93580066/179736315-1debc218-7e34-4fdf-b196-c459b7202313.png)

![image](https://user-images.githubusercontent.com/93580066/179736660-826ce20d-35f7-41c4-98a5-149dc311cf5e.png)

Partie 2 : Importation des fichiers de gestion


Un dossier nommé API est présent dans le repository, il vous suffit de le télécharger et de l'ajouter au même niveau que votre dossier wordpress.

Un fichier config.php est également dans le repository, il va permettre à l'ensemble des fichiers de se connecter à la base de données, il faut également le mettre
au même niveau que votre dossier wordpress

![image](https://user-images.githubusercontent.com/93580066/179718414-4263dcb5-a4af-447a-897a-9562829eb4e2.png)




Partie 3 : importation des pages wordpress


Pour l'importation des pages wordpress un fichier pages.xml est disponible, celui-ci, en passant par le tableau de bord wordpress permet d'importer les pages d'un site vers un autre.

![image](https://user-images.githubusercontent.com/93580066/179720794-1736c79b-54e6-4f0a-8308-6cce8f1902ea.png)




Partie 4 : Importation du plugin de création


Disponible dans FSA, le plugin kilyion.php permet à votre site de récupérez les entrées des formulaires wordpress afin de les envoyer vers les différents fichiers de création de personnel, de matériels ou de logiciels.

![image](https://user-images.githubusercontent.com/93580066/179722549-493d2cfc-2627-47eb-ae2d-9797344c33cd.png)




Notes : 

- Modification/Ajout de page

  Pour modifier ou ajouter une page il vous faudra les plugins elementor et elementor pro (disponible gratuitement sur internet)
  Mais également le thème elementor
  
Pour résoudre ce problème je suis actuellement en train d'écrrire à la main les différents formulaire en HTML, ainsi ils seront disponibles peu importe le thème utilisé

Je mettrai à jour au fur et à mesure les différents fichiers de création et également les fichiers d'affichage afin d'ajouter des fonctionnalités
