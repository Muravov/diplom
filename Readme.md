1. Установить <code>GitBash</code> (Далее работа идет в консоле git) 
2. Склонировать проект <br>
<code>git clone https://github.com/Muravov/diplom.git </code>
3. Установить composer. Перейти в корень проекта и выполнить <br> 
<code>composer update</code>
4. Запустить OpenServer, открыть phpMyAdmin, создать БД <code>diplom</code>.
5. В корне проекта, в папке backups взять бэкап и импортировать в созданную БД. (Выбрать БД diplom, вверху нажать Импорт, вставить бэкап)
6. В корне проекта запустить сервер symfony <code>php bin/console server:run</code>
7. Перейти на <url> http://localhost:8000/login </url>