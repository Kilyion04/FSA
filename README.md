# FSA

Partie 1: Importation de la BDD


Tout d'abord rendez-vous dans phphmyadmin et choisssisez la base de donnée où se trouve votre site wordpress.

Un fichier BDD.sql est disponible sur le repositeroty FSA, celui-ci contient un script à importer via phpmyadmin à l'aide du bouton importer.

![image](https://user-images.githubusercontent.com/93580066/179716973-924d51ad-2715-47fd-89ad-408f10fea1de.png)

Une fois cela fait les tables seront ajoutées à la BDD et celles déjà présentent, en raport avec wordpress (qui ont des préfixes wp_), seront mise à jour


Partie 2 : Importation des fichiers de gestion


Un dossier nommé API est présent dans le repository, il vous suffit de le télécharger et de l'ajouter au même niveau que votre dossier wordpress.
ex : fsa/site/api     fsa/site/wordpress

Un fichier config.php est également dans le repository, il va permettre à l'ensemble des fichiers de converser avec la base de données, il faut également le mettre
au même niveau que votre dossier wordpress

![image](https://user-images.githubusercontent.com/93580066/179718414-4263dcb5-a4af-447a-897a-9562829eb4e2.png)



Partie 3 : importation des pages wordpress

Pour l'importation des pages wordpress un fichier pages.xml est disponible, celui-ci, en passant par le tableau de bord wordpress permet d'importer les pages d'un site vers un autre.

![image](https://user-images.githubusercontent.com/93580066/179720794-1736c79b-54e6-4f0a-8308-6cce8f1902ea.png)



Partie 4 : Importation du plugin de création

Disponible dans FSA, le plugin kilyion.php permet à votre site de récupérrez les entrées des formulaires wordpress afin de les envoyer vers les différents fichiers de création de personnel, de matériels ou de logiciels.

![image](https://user-images.githubusercontent.com/93580066/179722549-493d2cfc-2627-47eb-ae2d-9797344c33cd.png)




Notes : 

- Modification/Ajout de page

  Pour modifier ou ajouter une page il vous faudra les plugins elementor et elementor pro (disponible gratuitement sur internet)
  Mais également le thème elementor
  
Pour résoudre ce problème je suis sactuellement en train d'écrrire à la main les différents formulaire en HTML ainsi ils seront disponibles peu importe le thème utilisé
