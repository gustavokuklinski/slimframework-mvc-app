# Slim Framework MVC - App
Projeto desenvolvido utilizando o Slim Framework em PHP.
Este projeto visa aproximar o Microframework nos conceitos básicos do MVC.

## Configuração
Renomear os arquivos:
phinx-sample.yml -> phinx.yml
app/config/settings-sample.php -> app/config/settings.php

Conexão com banco de dados MySQL(MariaDB) para rodar as migrações: phinx.yml
```
composer migratedb
```
Na pasta 'app/config/settings.php' configurar o banco de dados da aplicação Slim

Iniciar o servidor local(PHP) - localhost:8880
```
composer start
```

### Composer:
* Slim Framework: 3.x;
* PHP View: 2.2;
* Phinx: 0.11.4;

### Ambiente de desenvolvimento:
* Debian 10 - Stable;
* PHP 7.3;
* MariaDB 15.1;
