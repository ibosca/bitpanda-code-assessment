CURRENT_DIR := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
SHELL = /bin/sh

.PHONY: help
help:			## Print available targets.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

.PHONY: install
install:		## Install project dependencies and build infrastructure.
	@docker-compose up -d
	@composer install

.PHONY: run
run:			## Run the project.
	@docker-compose up -d
	@php artisan serve

.PHONY: test
test:			## Run tests.
	@php artisan test

.PHONY: clean
clean:			## Remove dependencies and infrastructure.
	@docker-compose down -v
	@rm -rf vendor


