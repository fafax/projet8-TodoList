


# ToDoList

Base du projet #8 : Améliorer un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1

## Installation du projet

* Cloner le projet avec la commande suivante :

```git clone https://github.com/fafax/projet8-TodoList.git```

* Entrer dans le dossier du projet avec la commande suivante :

```cd projet8-TodoList```

* Installer les dépendances avec la commande suivante: 

```composer install```

* Dupliquer le fichier .env en le renommant .env.local et configurer l'accès à la base de données en modifiant une des lignes ci-dessous :

```
###> doctrine/doctrine-bundle ###
   # Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
   # For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
   # For a PostgreSQL database, use: "postgresql://db_user:db_password@127.0.0.1:5432/db_name?serverVersion=11&charset=utf8"
   # IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
   DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7
   ###< doctrine/doctrine-bundle ###
```

* Réaliser l'étape précédente en créant un fichier .env.test

* Créer la base de données pour le projet et les tests avec la commande suivante :

``` php bin/console doctrine:database:create && php bin/console doctrine:database:create --env=test```

*. Création des tables de la base de données à l'aide de la commande suivante:

``` php bin/console doctrine:migrations:migrate ```

### jeu de données demo (partie optionnelle)

* Insérer des données fictives dans votre base de données avec la commande suivante: 

```php bin/console doctrine:fixtures:load```

## Réalisation des tests

### jeu de données pour les tests (Obligatoire pour la réussite des tests)

* Insérer des données pour la réussite des tests à l'aide du fichier [SQL](https://github.com/fafax/projet8-TodoList/blob/master/ressource%20p8/symfony-test.sql) , si les tables existent supprimer les préalablement.

* Puis exécuter la commande suivante pour s'assurer que chaque Task soit bien rattaché à un User .

``` php bin/console set-anonyme --env=test ```

* Pour lancer l'ensemble des tests, il vous suffit d'utiliser la commande :

``` php bin/phpunit ```

## Me suivre

- Author - [Fabien HAMAYON](https://www.linkedin.com/in/fabien-hamayon-2b072698/)

- Website - [code assembly dev](http://codeassemblydev.fr/)

- Youtube - [Youtube channel](https://www.youtube.com/channel/UCBB2pQPkS2jmI3LPhUCxYgA)