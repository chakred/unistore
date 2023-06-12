# Create .env
env:
	cp .env.example .env

# Build containers and run
build-and-run:
	docker-compose build
	docker-compose up -d

# Execute app container
exec-app:
	docker-compose exec app bash

# Stop containers
stop:
	docker-compose stop

# Start containes
start:
	docker-compose start

# Check containers status
ps:
	docker-compose ps