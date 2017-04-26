<?php

return [

    /**
     * Settings text strings
     * Contains all text strings used in the general settings sections of BookStack
     * including users and roles.
     */

    'settings' => 'Настройки',
    'settings_save' => 'Сохранить настройки',
    'settings_save_success' => 'Настройки сохранены',

    /**
     * App settings
     */

    'app_settings' => 'Настройки приложения',
    'app_name' => 'Имя приложения',
    'app_name_desc' => 'Это имя отображается в верхней строке и во всех сообщениях электронной почты.',
    'app_name_header' => 'Показывать имя приложения в верхней строке?',
    'app_public_viewing' => 'Разрешить публичный просмотр?',
    'app_secure_images' => 'Разрешить загрузку изображений повышенной безопасности?',
    'app_secure_images_desc' => 'Для повышения производительности, все изображения хранятся публично. Данная опция включает добавление случайной сложно предсказуемой строки перед сылками изображений. Проверьте, что у Вас отключен индекс папки (Directory Indexes) в настройках сервера.',
    'app_editor' => 'Редактор',
    'app_editor_desc' => 'Выберете какой редактор будет использован всеми пользователями.',
    'app_custom_html' => 'Собственный код в HTML заголовоке',
    'app_custom_html_desc' => 'Любой код, давленный здесь будет вставлен внизу раздела <head> на каждой странице. Используется для перезаписи стилей или добавления кода аналитики.',
    'app_logo' => 'Лого приложения',
    'app_logo_desc' => 'Это изображение должно быть не выше 43px. <br>Большие изображения будут уменьшены автоматически.',
    'app_primary_color' => 'Основной цвет приложения',
    'app_primary_color_desc' => 'Должен быть в формате HEX. <br>Оставьте пустым для использования цвета  по умолчанию.',

    /**
     * Registration settings
     */

    'reg_settings' => 'Настройки регистрации',
    'reg_allow' => 'Разрешить регистрацию?',
    'reg_default_role' => 'Роль пользователя по умолчанию после регистрации',
    'reg_confirm_email' => 'Требовать подтверждения адреса электронной почты?',
    'reg_confirm_email_desc' => 'Если ограничение доменов включено, тогда будет необходимо подтверждение электронной почты и адреса из списка будут проигнорированы.',
    'reg_confirm_restrict_domain' => 'Ограничить регистрацию для доменов',
    'reg_confirm_restrict_domain_desc' => 'Введите список доменов электронной почты, разделенных запятыми, которым вы бы хотели ограничить регистрацию. Всем пользователям будет необходимо подтверждать адрес электонной почты при регистрации. <br> Заметьте, что пользователи смогут изменять свой почтовый адрес на запрещенный после успешной регистрации.',
    'reg_confirm_restrict_domain_placeholder' => 'Ограничений нет',

    /**
     * Role settings
     */

    'roles' => 'Роли',
    'role_user_roles' => 'Роли пользователя',
    'role_create' => 'Создать роль',
    'role_create_success' => 'Роль успешно создана',
    'role_delete' => 'Удалить роль',
    'role_delete_confirm' => 'Это приведёт к удалению роли \':roleName\'.',
    'role_delete_users_assigned' => 'Эта роль содержит :userCount пользователей. Если вы хотите перенести пользователей в другую роль, укажите её ниже.',
    'role_delete_no_migration' => "Не переносить пользователей",
    'role_delete_sure' => 'Вы уверены, что хотите удалить эту роль?',
    'role_delete_success' => 'Роль удалена успешно!',
    'role_edit' => 'Редактировать роль',
    'role_details' => 'Настройки по умолчанию',
    'role_name' => 'Имя Роли',
    'role_desc' => 'Короткое описание роли',
    'role_system' => 'Системные права',
    'role_manage_users' => 'Управление пользователями',
    'role_manage_roles' => 'Управление ролями и правами ролей',
    'role_manage_entity_permissions' => 'Управление правами всех книг, разделов и страниц.',
    'role_manage_own_entity_permissions' => 'Управление правами собственых книг, разделов и страниц',
    'role_manage_settings' => 'Управление настройками приложения',
    'role_asset' => 'Права на объекты',
    'role_asset_desc' => 'Эти правав определяют доступ по умолчанию ко всем объектам в системе. Права на Книги, Разделы и Страницы имеют более высокий приоритет.',
    'role_all' => 'Все',
    'role_own' => 'Свои',
    'role_controlled_by_asset' => 'Контролируется объектом, куда производится загрузка',
    'role_save' => 'Сохранить роль',
    'role_update_success' => 'Роль обновлена успешно!',
    'role_users' => 'Пользватели в этой роли:',
    'role_users_none' => 'Пока пользователей не добавлено',

    /**
     * Users
     */

    'users' => 'Пользователи',
    'user_profile' => 'Профиль пользователя',
    'users_add_new' => 'Добавить пользователя',
    'users_search' => 'Поиск пользователя',
    'users_role' => 'Роли пользователя',
    'users_external_auth_id' => 'ID внешней аутентификации',
    'users_password_warning' => 'Заполняйте ниже только если хотите изменить Ваш пароль:',
    'users_system_public' => 'Этот пользователь представляет любого гостевого пользователя, который посещает Ваш сервис. Он не может быть использован для входа, он присваивается автоматически.',
    'users_delete' => 'Удалить пользователя',
    'users_delete_named' => 'Удалить пользователя :userName',
    'users_delete_warning' => 'Это действие полностью удалит пользователя с именем \':userName\' из системы.',
    'users_delete_confirm' => 'Вы уверены, что хотите удалить этого пользоваля?',
    'users_delete_success' => 'Пользователь успешно удалены',
    'users_edit' => 'Редактировать пользователя',
    'users_edit_profile' => 'Редактировать профиль',
    'users_edit_success' => 'Пользователь изменён успешно!',
    'users_avatar' => 'Аватар пользователя',
    'users_avatar_desc' => 'Это изображение должно быть квадратным с шириной в  256px.',
    'users_preferred_language' => 'Язык',
    'users_social_accounts' => 'Aккаунты социальных сетей',
    'users_social_accounts_info' => 'Здесь вы можете подключить ваши другие аккаунты для быстрого и простого входа. Отключение аккаунта здесь не отзывает полученного доступа. Отзовите доступ аккаунта социальных сетей из настроек вашего профиля.',
    'users_social_connect' => 'Подключить аккаунт',
    'users_social_disconnect' => 'Отключить аккаунт',
    'users_social_connected' => 'Аккаунт :socialAccount был успешно подключен к вашему профилю.',
    'users_social_disconnected' => 'Аккаунт :socialAccount был успешно отключен от вашего профиля.',

];