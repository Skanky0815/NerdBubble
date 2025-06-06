dockerPHP = docker compose exec -it backend php

start_server:
	cd ./server && ./vendor/bin/sail up

start_client:
	npm run start --prefix app

dev_storybook:
	npm run storybook --prefix app

test_setup_e2e:
	${dockerPHP} artisan migrate:fresh --seed --seeder=E2ETestSeeder

test_e2e:
	npm run cypress:open --prefix app

test_server_architecture:
	cd ./server && ${dockerPHP} vendor/bin/deptrac analyse --report-uncovered

php_cs_fix:
	cd ./server && ${dockerPHP} vendor/bin/php-cs-fixer fix --allow-risky=yes --diff

php_ide_helper_models:
	${dockerPHP} artisan ide-helper:models --dir="src/App/Models"
