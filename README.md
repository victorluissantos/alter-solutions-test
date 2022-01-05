## Como rodar
utilize o comando a baixo para iniciar o docker
1. `docker-compose up -d`
Acesse o container, primeiro utiliza o cmando a baixo para pegar o container_id do PHP:
2. `docker ps`
Depois de ter pego o id do container, utilize o comando a baixo para acessar o container
3. `docker exec -ti <container_id> sh -c /bin/sh`

Baixe as Dependencias do composer, utilizando o comando a baixo
1. `composer update`

## Services
Inserir um novo usuario
`php app.php user:create victor santos victorluissantos@live.com`

Inserir um novo usuario informando a idade
`php app.php user:create victor santos victorluissantos@live.com 30`

Atualizar senha do usuario
`php app.php user:create-pwd 2 a1b2.@ a1b2.@`