# pontential-crud
A solução para a proficiência foi desenvolvida em linguagem PHP

# Backend
api/delete.php						//API de exclusão de registros
api/get_all.php						//API que retorna a lista de todos os registros
api/get.php                         //API que retorna um registro apenas
api/post.php                        //API que inclui um registro
api/put.php                         //API que altera os registros
class/developers.php                //CLASSE para manutenção da tabela de desenvolvedores
config/database.php                 //CLASSE de tratamento do banco de dados

# Frontend
index.php                           //interface principal do projeto, em SPA
fetch.php                           //trata as requisições de lista do AJAX SPA
action.php                          //trata as requisições CRUD do AJAX SPA

# Especificação
sql/create database.sql             //cria a database do projeto
sql/create table developers.sql     //cria a tabela de desenvolvedores
sql/create teste data.sql           //gera dados para testes

# API endpoints
/api/*                              //os end points foram criados de acordo com as necessidades do CRUD 

# Entrega
docker images                       //utilizadas uma imagem para mysql e outra para php
webdevops/php-apache:debian-8       //repo para execucao do linux, php e do apache
mysql:5.7                           //repo para execucao do linux e do mysql
unittests/developers.postman.json   //coleção de testes unitários para cada end point



# ---------    ORIGINAL    ---------
# pontential-crud
Potencial para um crud

# Backend
Desenvolver uma API JSON REST na *linguagem a sua escolha*, que utilize os métodos (​GET​, ​POST​, ​PUT​,
DELETE​).

# Frontend
UI/UX fica a critério do desenvolvedor porém deverá ser SPA (single-page
application) e atender o consumo de todos endpoints da API 

# Especificação
Monte uma base de desenvolvedores com a seguinte estrutura:

```
nome: varchar
sexo: char
idade: integer
hobby: varchar
datanascimento: date
```

Utilize o ​banco de dados​ de sua preferência para armazenar os dados que a API irá
consumir.

# API endpoints

```
GET /developers
Codes 200
```
Retorna todos os desenvolvedores

```
GET /developers?
Codes 200 / 404
```
Retorna os desenvolvedores de acordo com o termo passado via querystring e
paginação

```
GET /developers/{id}
Codes 200 / 404
```/
Retorna os dados de um desenvolvedor

```
POST /developers
Codes 201 / 400
```
Adiciona um novo desenvolvedor

```
PUT /developers/{id}
Codes 200 / 400
```
Atualiza os dados de um desenvolvedor

```
DELETE /developers/{id}
Codes 204 / 400
```
Apaga o registro de um desenvolvedor


# Entrega
A aplicação deve rodar em docker, possuir um script para geração das tabelas no banco de dados e TESTES UNITÁRIOS.

Após finalizado o link do projeto, por e-mail, no github com explicação no README


