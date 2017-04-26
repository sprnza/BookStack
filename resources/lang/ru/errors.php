<?php

return [

    /**
     * Error text strings.
     */

    // Permissions
    'permission' => 'У вас не хватает прав для доступа к этой странице.',
    'permissionJson' => 'У вас не хватает прав для этого действия.',

    // Auth
    'error_user_exists_different_creds' => 'Пользователь с адресом электронной почты :email, но с другими реквизитами уже сущесвует.',
    'email_already_confirmed' => 'Адрес электронной почты уже подтвержден, попробуйте залогиниться.',
    'email_confirmation_invalid' => 'Эта ссылка подтверждения не активна или уже была использвоана, попробуйте зарегистрироваться ещё один раз.',
    'email_confirmation_expired' => 'Эта ссылка подтверждения просросчена, новая была выслана повторно.',
    'ldap_fail_anonymous' => 'Анонимный доступ по LDAP не удачен',
    'ldap_fail_authed' => 'Доступ по LDAP используя эти учётные данные не удачен',
    'ldap_extension_not_installed' => 'PHP расшиерение LDAP не установлено',
    'ldap_cannot_connect' => 'Невозможно подключиться к LDAP серверу, первичное соединение неудачно',
    'social_no_action_defined' => 'Действие не определено',
    'social_account_in_use' => 'Аккаунт :socialAccount уже используется, попробуйте залогиниться.',
    'social_account_email_in_use' => 'Адрес электронной почты :email уже используется. Если у Вас уже есть аккаунт, вы можете подключить аккаунт :socialAccount в настройках Вашего профиля.',
    'social_account_existing' => 'Аккаунт :socialAccount уже подключен к Вашему профилю.',
    'social_account_already_used_existing' => 'Аккаунт :socialAccount уже используется другим пользователем.',
    'social_account_not_used' => 'Аккаунт :socialAccount не подключен ни к одному профилю пользователя. Пожалуйста подключите его в настройках Вашего профиля. ',
    'social_account_register_instructions' => 'Если у вас нет аккаунта, Вы можете зарегитрироваться используя опцию :socialAccount.',
    'social_driver_not_found' => 'Драйвер социальных сетей не найден',
    'social_driver_not_configured' => 'Ваши настройки для :socialAccount не верны.',

    // System
    'path_not_writable' => 'Файл не может быть загружен по пути :filePath. Проверьте права и владельца.',
    'cannot_get_image_from_url' => 'Невозможно получить изображение по ссылке :url',
    'cannot_create_thumbs' => 'Сервер не создает миниатюрые изображения. Пожалуйста, проверьте, что расширение PHP GD установлено.',
    'server_upload_limit' => 'Сервер не позволяет загружать файлы такого размера. Пожалуйста попробуйте файл меньшего размера.',
    'image_upload_error' => 'Произошла ошибка при загрузке изображения',

    // Attachments
    'attachment_page_mismatch' => 'Не совпадение страницы во время обновления вложения',

    // Pages
    'page_draft_autosave_fail' => 'Невозможно сохранить черновик. Проверьте Ваше Интернет соединение перед сохранением этой страницы',

    // Entities
    'entity_not_found' => 'Объект не найден',
    'book_not_found' => 'Книга не найдена',
    'page_not_found' => 'Страница не найдена',
    'chapter_not_found' => 'Раздел не найден',
    'selected_book_not_found' => 'Выбранная книга на найдена',
    'selected_book_chapter_not_found' => 'Выбранная книга или раздел не найден',
    'guests_cannot_save_drafts' => 'Гости не могут сохранять черновики',

    // Users
    'users_cannot_delete_only_admin' => 'Вы не можете удалить единственного администратора',
    'users_cannot_delete_guest' => 'Вы не можете удалить гостевого пользователя',

    // Roles
    'role_cannot_be_edited' => 'Эта роль не может быть изменена',
    'role_system_cannot_be_deleted' => 'Эта роль- системная и не может быть удалена',
    'role_registration_default_cannot_delete' => 'Эта роль не может быть удалена, пока выбрана ролью по умолчанию при регистрации',

    // Error pages
    '404_page_not_found' => 'Страница не найдена',
    'sorry_page_not_found' => 'Извините, страница, которую Вы ищите, не может быть найдена.',
    'return_home' => 'На домашнюю страницу',
    'error_occurred' => 'Возникла ошибка',
    'app_down' => ':appName сейчас не работает',
    'back_soon' => 'Скоро сервис будет восстановлен.',
];
