# permission must have
# -rw------- 1 root 295 Nov 0 22:41 cron.php

SHELL=/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

# Удаление базы
1 1 * * 1 rm -rf /nod32-base/v*
1 1 * * 1 rm -rf /nod32-base/ep*

# Запуск с задержкой скрипта обновления
12 */6 * * * /bin/sleep `/usr/bin/od -An -N1 -i /dev/urandom`; /usr/local/bin/php /eset_mirror_script/update.php

# Запуск при старте контейнера
@reboot /usr/local/bin/php /eset_mirror_script/update.php

@reboot [ ! -f /nod32-base/favicon.ico  ] && cp /favicon.ico /nod32-base/favicon.ico

