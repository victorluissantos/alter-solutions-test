#### Entrando no container ####
Sera necessario entrar no container para instalar o composer:
1. `docker ps`
Pega o id do conateiner
2.  `docker exec -ti <container_id> sh -c /bin/sh`
2. composer update
