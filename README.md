# Alexandre Dosseto
## Openclassrooms,P5,Blog

Codacy :
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ab9771a0c4d14be5a22fea3874eadae0)](https://app.codacy.com/gh/Alex-dos/OC_P5_Blog?utm_source=github.com&utm_medium=referral&utm_content=Alex-dos/OC_P5_Blog&utm_campaign=Badge_Grade_Settings)

## Pré-requis :
- PHP 7.4
- MySQL
- Apache


## Installation :

Téléchargez composer et copiez-collez les liens suivants dans votre terminal shell à la racine du projet:
```shell
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

```shell
$ composer install
```



- Importer la structure ainsi qu'un jeu de donnée avec le fichier BDD.sql vers votre base créé auparavant.

- Configurer la connexion à la base de donnée en renommant le fichier "config.ini.dist" par "config.ini".

- L'adresse du serveur doit pointer à la racine du dossier.

