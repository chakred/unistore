# Create .env
env:
	cp .env.example .env

build-and-run:
	docker-compose build
	docker-compose up -d

exec-app:
	docker-compose exec app bash