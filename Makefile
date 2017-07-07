install:
	composer install

update:
	composer update
run:
	./yii serve --port=3030

create-tables:
	mysql -u $(USER) -p weather < dbModel.sql
