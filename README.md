# Chronis

As `cron` expressions are not easy to understand and write, `Chronis` will help you define
cron jobs using natural language and will generate crontab files for you. 

This will also allow you to `verison control` your cron job definitions in a structured
file (YAML) and generate crontabs during your `deployment` process. 

## Usage

### Prerequisites

PHP 7 is required for `Chronis` to run.

### Installing

To include `Chronis` in your PHP project:

```
composer require mylk/chronis
```

### Run

To execute `Chronis` and get some help: 

```
vendor/bin/chronis list
```

Then, you will need to have a `yaml` file to define your cron jobs. You can begin with
[this](https://github.com/mylk/chronis/blob/master/config/chronis.example.yaml) as an example.

To dump the crontab:

```
vendor/bin/chronis dump --config=YOUR_YAML_FILE_PATH
```

To export the crontab:

```
vendor/bin/chronis export --config=YOUR_YAML_FILE_PATH --output=my_crontab
```

The `--output` argument is not necessary. If not given, the crontab will be exported to a file
named `crontab` in the current directory.

## Contributing

`Chronis` is open source and of course you can contribute. Just fork the project, have fun
and then create a pull request.

A `Makefile` has been created to group some tasks needed for development. Find those tasks below.

### Running the tests

```
make tests
```

### Syntax checks

```
make check-syntax
```

### Coding style checks

The coding style that is followed is [PSR-2](https://www.php-fig.org/psr/psr-2/).

```
make check-style

```

### Quality checks

```
make check-quality

```

## Built With

* [symfony/console](https://symfony.com/components/Console) - The library used for the command line interface
* [bpolaszek/natural-cron-expression](https://github.com/bpolaszek/natural-cron-expression) - The library that converts the natural language to cron expressions
* [symfony/yaml](https://symfony.com/components/Yaml) - The library used to read the YAML configuration of your cron jobs
* [symfony/dependency-injection](https://symfony.com/components/DependencyInjection) - The library that instantiates the sevices used in the project 

## Versioning

[SemVer](http://semver.org/) is used for versioning. For the versions available, see the [tags](https://github.com/mylk/chronis/tags). 

## Authors

See the list of [contributors](https://github.com/your/project/contributors).

## License

This project is licensed under the GPLv2 License - see the [LICENSE](LICENSE) file for details.
