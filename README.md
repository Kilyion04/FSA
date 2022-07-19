# FSA

Partie 1: Importation de la BDD


Tout d'abord rendez-vous dans phphmyadmin et choisssisez la base de donnée où se trouve votre site wordpress.

Un fichier BDD.sql est disponible sur le repositeroty FSA, celui-ci contient un script à importer via phpmyadmin à l'aide du bouton importer.

![image](https://user-images.githubusercontent.com/93580066/179716973-924d51ad-2715-47fd-89ad-408f10fea1de.png)

Une fois cela fait les tables seront ajouter à la BDD et celles déjà préssentent, en raport avec wordpress seront mise à jour


Partie 2 : Importation des fichiers de gestion


Un dossier nommé API est présent dans le repository, il vous suffit de le télécharger et de l'ajouter au même niveau que votre dossier wordpress.
ex : fsa/site/api     fsa/site/wordpress

Un fichier config.php est également dans le repository, il va permettre à l'ensemble des fichiers de converser avec la base de données, il faut également le mettre
au même niveau que votre dossier wordpress

![image](https://user-images.githubusercontent.com/93580066/179718414-4263dcb5-a4af-447a-897a-9562829eb4e2.png)
