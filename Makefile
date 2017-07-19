install:
	composer install

update:
	composer update
run:
	./yii serve --port=3030

migration-up:
	./yii migrate

migration-down:
	./yii migrate/down
