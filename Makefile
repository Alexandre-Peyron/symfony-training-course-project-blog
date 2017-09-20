build:
	$(MAKE) composer-install
	$(MAKE) database
	$(MAKE) database-update
	$(MAKE) fixtures
	$(MAKE) npm-install
	$(MAKE) bower-install
	$(MAKE) gulp-build

cache-clear:
	php bin/console cache:clear --no-warmup

composer-install:
	composer install

composer-update:
	composer update

database:
	php bin/console doctrine:schema:drop --force
	php bin/console doctrine:schema:create

database-update:
	php bin/console doctrine:schema:update --dump-sql --force

fixtures:
	php bin/console doctrine:fixtures:load --quiet

npm-install:
	npm install

bower-install:
	bower install

gulp-build:
	gulp build



