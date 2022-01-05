## Como rodar

1. Utilize o comando abaixo para iniciar o docker:
`docker-compose up -d`

2. Acesse o container utilizando o comando abaixo para selecionar o **container_id** do PHP:
`docker ps`

3. Depois de ter selecionado o id do container, utilize o comando abaixo para acessar o container:
`docker exec -ti <container_id> sh -c /bin/sh`

4. Por fim, baixe as dependências do composer utilizando o comando a seguir:
`docker exec -ti <container_id> sh -c /bin/sh`

## Services

1. Use este comando para inserir um novo usuário:
`docker exec -ti <container_id> sh -c /bin/sh`

2. Use este comando para inserir um novo usuário informando a idade:
`php app.php user:create victor santos victorluissantos@live.com 30`

3. Use este comando para atualizar a senha do usuário:
`php app.php user:create-pwd 2 a1b2.@ a1b2.@`
