install:
	composer install

update:
	composer update
run:
	./yii serve --port=3040

migration-up:
	./yii migrate

migration-down:
	./yii migrate/down

linter:
	composer exec php-cs-fixer .

linter-fix:
	composer exec php-cs-fixer fix .

