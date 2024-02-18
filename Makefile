
#################################################
# command for docker-compose
#################################################

nginx.logs:
	docker-compose logs -f l10dev-nginx

nginx.shell:
	docker-compose exec l10dev-nginx /bin/bash


app.logs:
	docker-compose logs -f l10dev-app

app.shell:
	docker-compose exec l10dev-app /bin/bash


mysql.logs:
	docker-compose logs -f l10dev-mysql

mysql.shell:
	docker-compose exec l10dev-mysql /bin/bash

redis.logs:
	docker-compose logs -f l10dev-redis

redis.shell:
	docker-compose exec l10dev-redis /bin/bash
