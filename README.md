# Система управления рестораном

##Инструкции

- Запуск команд в контейнере php-fpm:
docker exec -it $(docker ps | grep project_r_php-fpm | cut -d " " -f1) ./bin/console 