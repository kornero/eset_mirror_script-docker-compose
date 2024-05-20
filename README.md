# eset_mirror_script-docker-compose  
ESET NOD32 UPDATE SCRIPT in docker-compose (nginx+php)  

## How to:
### Запуск
```
git clone https://github.com/kornero/eset_mirror_script-docker-compose.git
cd eset_mirror_script-docker-compose/
cp .env-default .env
cp nginx/htpasswd-default nginx/htpasswd
docker compose up --build -d --remove-orphans --force-recreate
#либо для старого докера через дефис: docker-compose up --build -d --remove-orphans --force-recreate
```
### Выключение:
`docker compose down --remove-orphans`
### Логи:
`docker logs -f eset-nod32_nginx`
### Консоль:
`docker exec -i -t eset-nod32_nginx /bin/sh`

## Мои фиксы: 
### Пока включил версии 8, 14 для вин10 только для x64.
```
http://forum.ru-board.com/topic.cgi?forum=35&topic=52635&start=5160#18

Отмечу пару важных моментов, по опыту/наблюдениям/эксплуатации антивируса ESET:
1. Если установлен такой раритет, как Windows XP (аминь) - однозначный выбор из домашних версий и из бизнес-версий - это Eset Antivirus (EAV,ESS,EABE,ESSBE) v.4. Нет смысла устанавливать что-то выше, если нет специфических единичных причин. Эта версия наиболее доработана под данную операционную систему.
2. Если установлен такой раритет, как Windows 7 - оптимальный выбор из домашних версий - это Eset Antivirus (EAV,ESS) v.8, а из бизнес-версий - это Eset Endpoint Antivirus (EEA,EES) v.6. Нет смысла устанавливать что-то выше или ниже, если нет специфических единичных причин. Эти версии наиболее доработаны под данную операционную систему.
3. Если установлена Windows 10 - оптимальный выбор из домашних версий - это Eset Antivirus (EAV,EIS,ESSP) v.14, а из бизнес-версий - это Eset Endpoint Antivirus (EEA, EES) v.8.  Нет смысла устанавливать что-то выше или ниже, если нет специфических единичных причин. Эти версии наиболее доработаны под данную операционную систему.
4. Если установлена Windows 11 - оптимальный выбор из домашних версий - это Eset Antivirus (EAV,EIS,ESSP) не ниже v.15, а из бизнес-версий - это Eset Endpoint Antivirus (EEA, EES) не ниже v.9. Нет смысла устанавливать что-то ниже, если нет специфических единичных причин. Эти версии наиболее доработаны под данную операционную систему.
5. Если установлена серверная Windows, не культурно устанавливать на неё домашние версии антивируса, если нет специфических единичных причин. Для серверной версии Windows имеется своя линейка антивируса ESET File Security (ESET Server Security), желательно устанавливать версию  не ниже v.6.
```
### Отключил пароль и прописал:
```
IP_PORT=192.168.0.141:1222
DATA_PATH=/opt/eset
```
### Референсы:
```
https://forum.lissyara.su/soft-f3/shustryj-skript-skript-zerkala-nod32-t42296-s1500.html
http://forum.ru-board.com/topic.cgi?forum=35&topic=52596#1

До этого использовал:
http://upnod.duckdns.org (ESS/EAV v4-5-6-7-8-9 рус eng)
который update.nod (задан в hosts)
Login: ru-board
Passwd: PTjPEHyG5vej
```

# Описание скопировано с других репо:

## Проект контейнера для зеркала антивирусных баз для ESET-NOD32
Базы подготавливаются с помощью скрипта из репозитория  
https://github.com/Kingston-kms/eset_mirror_script

## В проекте используются  
- nginx (https://github.com/nginxinc/docker-nginx)
- php https://github.com/docker-library/docs/tree/master/php

## Клонируйте проект
```
git clone https://github.com/ErshovSergey/eset_mirror_script-docker-compose.git
cd eset_mirror_script-docker-compose
```
## Настройки - делать до создания контейнера
### Скопировать настройки контейнеров
```
cp .env-default .env
```
Определить адрес, порт и каталог для хранения антивирусных баз.

### Скопировать файл с паролями
```
cp nginx/htpasswd-default nginx/htpasswd
```
Добавить пароли в файл *nginx/htpasswd*, если необходимо.
По умолчанию есть учетная запись admin/admin
### Настроки скрипта обновления (после изменения необходимо пересобрать проект)  
Файл настроек скрипта обновления находится в *php/nod32ms.conf*.  
Подробнее в https://github.com/Kingston-kms/eset_mirror_script  
### Настроки запуска скрипта обновления  
Файл cron для запуска скрипта обновления находится в *php/cron.php*.  
Если не работает - проверить разрешения на файл.

## Команды
### Ручной запуск скрипта обновления из контейнера **php**  
```
docker exec -i -t <php_container_name> php /eset_mirror_script/update.php
```
### Логи раздачи файлов 
```
docker  logs -f <nginx_container_name>
```
### Запуск, остановка/удаление  
Произвести/изменить необходимые настройки и 
###   пересобрать проект
```
docker-compose up --build -d --remove-orphans --force-recreate
```
#### Удаление проекта
```
docker-compose down --remove-orphans
```
#### Обновить используемые образы
```
docker pull nginx:latest
docker pull php:7.2-cli
```
После обновления пересобрать образы
