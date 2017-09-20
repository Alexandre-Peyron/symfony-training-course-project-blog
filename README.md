symfony-training-course-project
===============================

Projet utilisé dans le cadre de mes cours sur Symfony.


### Prérequis :

- Avoir [Composer](https://getcomposer.org/download/) installé
- Avoir [NodeJS](https://nodejs.org/fr/) installé
- Avoir [Bower](https://bower.io/) installé
- Avoir [Gulp](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md) installé
- Pouvoir utiliser la commande "make"


### Installation du projet :

Clonez le projet.

Mettez à jour votre `app/config/parameters.yml`

Lancer la commande `make build`

Si make n'est pas disponible, exécutez dans l'ordre :

- composer install
- php bin/console doctrine:schema:drop --force
- php bin/console doctrine:schema:create
- php bin/console doctrine:schema:update --dump-sql --force
- php bin/console doctrine:fixtures:load --quiet
- npm install
- bower install
- gulp build


### Sources externes

Template
- [Gentalella Admin Template](https://github.com/puikinsh/gentelella)

Framework CSS
- [Bootstrap sass](https://github.com/twbs/bootstrap-sass)

JS
- [jQuery](https://jquery.com/)
- [Datatables](https://datatables.net/)

Fonts
- [Font Awesome](http://fontawesome.io/)
