
# Guide pour contribuer au projet

## Récupération du projet

* Connectez-vous à votre compte github.
* A l'aide du bouton Fork, faites une copie du [projet origine](https://github.com/fafax/projet8-TodoList).
* Récupérer les fichiers localement à l'aide de la commande clone.

```git clone https://github.com/VotrePseudoGitHub/projet8-TodoList.git```

* Installer les dépendances en suivant les différentes étapes du [README.md](https://github.com/fafax/projet8-TodoList/blob/master/README.md).

## Développement

* Créer une branche pour réaliser vos modifications avec la commande suivante:

```git checkout -b nom-de-la-branche```

* Développer votre code tout en respectant les normes PSR et en réalisant les tests associés à vos developpements.
* Pour s'assurer d'avoir un historique de vos développements, pensez à réaliser régulièrement des commits avec les commandes suivantes :

```
git add .
git commit -m "Description de l'evolution ou de la modification"
```

## Processus de qualité

* Avant de pousser vos modifications, vous devez vous assurer que l'intégralité des tests soit OK  lors du lancement de la commande:

``` php bin/phpunit ```
* Assurez-vous que vous ne descendiez pas à moins de 75% de couverture totale au niveau des tests en générant le code coverage à l'aide de la commande suivante :

``` php bin/phpunit --coverage-html ./coverage ```

* Pour implémenter les tests liés à votre code, veuillez-vous référer à la documentation officielle de Symfony et la documentation de PHPUnit

* Pousser vos changements sur le dépot distant github :

```git push origin nom-de-la-branche```

* Vérifier que la qualité de votre code respecte bien les standards en utilisant la plateforme [code climate](https://codeclimate.com/).
Vos évolutions ne doivent pas changer la lettre de la qualité du code [![Maintainability](https://api.codeclimate.com/v1/badges/bcb2fc5b385339703abb/maintainability)](https://codeclimate.com/github/fafax/projet8-TodoList/maintainability)

* Puis proposer votre développement à l'aide d'une pull request