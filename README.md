#### Entrando no container ####
Sera necessario entrar no container para instalar o composer:
1. `docker ps`
Pega o id do conateiner
2.  `docker exec -ti <container_id> sh -c /bin/sh`
2. composer update


## Services

Inserir um novo usuario
`php app.php user:create victor santos victorluissantos@live.com`

ou informando uma idade
`php app.php user:create victor santos victorluissantos@live.com 30`

Atualizar senha do usuario
`php app.php user:create-pwd 1 5tgbBGT%..@`