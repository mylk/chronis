test:
	vendor/bin/phpunit tests/

check-syntax:
	find src -name *.php -exec php -l {} \;

check-style:
	vendor/bin/phpcs --standard=PSR2 src/

chekc-quality:
	vendor/bin/phpmd src/ text cleancode,codesize,controversial,design,naming,unusedcode
