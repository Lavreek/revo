# Revo-test.site
Для создания и удаления карточек "Реализованные проекты" страницы Fluid-line.ru "ГЛАВНАЯ / ВАШ ФАЙЛ С ЗАКАЗОМ"

# Пример

gitimages -> example.png

# Usage Symfony

Добавить в проект 3 контроллера обработки и 1 приёмки

<ul>
	<li>src/Controller/ApiController</li>
	<li>src/Service/FluidlineController</li>
	<li>src/Service/RevotestController</li>
	<li>src/Service/SupportController</li>
</ul>

ApiController - принимает результат отправки формы, с ключевыми полями.

# add

input [name = push_id] 

# delete

input [delete = delete_id] 

# Revo Settings

Form:
	<li>Host</li>
	<li>User</li>
	<li>Password</li>
	<li>Dbname</li>
	<li>Port</li>

# Fluid Settings

Form:
	<li>Host</li>
	<li>User</li>
	<li>Password</li>
	<li>Dbname</li>
	<li>Port</li>

Использование потребует: HTTP Foundation.
Использование шаблона потребует: Bootstrap (css/js), jquery.

# Usage Single

1) Поместить контроллеры в одну связную папку.
2) Создать файл приёмник.
3) Создать экземпляр класса:

require_once __DIR__."/ApiController.php"
Api = new ApiController()

Для использования функций описанных выше, вместо request использовать глобальное определение "$_POST" и передавать его в функции исключая мусор.
unset($_POST['add'])

# Возвращаемый результат

Результат возвращается в виде json строки.
