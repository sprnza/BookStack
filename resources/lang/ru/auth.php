<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    'failed' => 'Учётная запись не существует.',
    'throttle' => 'Очень много попыток. Попробуйте повторить через :seconds секунд.',

    /**
     * Login & Register
     */
    'sign_up' => 'Регистрация',
    'log_in' => 'Вход',
    'log_in_with' => 'Вход через :socialDriver',
    'sign_up_with' => 'Регистрация через :socialDriver',
    'logout' => 'Выход',

    'name' => 'Имя',
    'username' => 'Имя пользователя',
    'email' => 'Почта',
    'password' => 'Пароль',
    'password_confirm' => 'Подтверждение пароля',
    'password_hint' => 'Должен быть больше 5 символов',
    'forgot_password' => 'Забыли пароль?',
    'remember_me' => 'Напомните мне',
    'ldap_email_hint' => 'Пожалуйста, введи адрес почты для использования этого аккаунта .',
    'create_account' => 'Создать аккаунт',
    'social_login' => 'Вход через социальные сети',
    'social_registration' => 'Регистрация через социальные сети',
    'social_registration_text' => 'Зарегистрируйтесь и войдите при помощи другого сервиса.',

    'register_thanks' => 'Спасибо за регистрацию!',
    'register_confirm' => 'Пожалуйста, проверьте свою электронную почту и нажмите на кнопку подтверждения регистрации для доступа к :appName.',
    'registrations_disabled' => 'Регистрация закрыта',
    'registration_email_domain_invalid' => 'Этот адрес электронной почты не может быть использован для доступа',
    'register_success' => 'Спасибо за регистрацию!',


    /**
     * Password Reset
     */
    'reset_password' => 'Сбросить пароль',
    'reset_password_send_instructions' => 'Введите ниже Ваш адрес электронной почты и вам будет выслано письмо со ссылкой для сброса пароля.',
    'reset_password_send_button' => 'Отправить ссылу для сброса пароля.',
    'reset_password_sent_success' => 'Ссылка для сброса пароля была отправлена на :email.',
    'reset_password_success' => 'Ваш пароль был успешно сброшен.',

    'email_reset_subject' => 'Сбросить ваш пароль к :appName',
    'email_reset_text' => 'Вы получили это письмо, потому что мы получили запрос на сброс пароля Вашего аккаунта.',
    'email_reset_not_requested' => 'Если вы не отправляели этот запрос просто проигнорируйте это письмо.',


    /**
     * Email Confirmation
     */
    'email_confirm_subject' => 'Подтверждение адреса электронной почты для :appName',
    'email_confirm_greeting' => 'Спасибо за использование :appName!',
    'email_confirm_text' => 'Пожалуйста, подтвердите Ваш адрес электронной почты нажатием кнопки, расположенной ниже:',
    'email_confirm_action' => 'Подтвердить',
    'email_confirm_send_error' => 'Необходимо подтверждение электронной почты, но система не может отправить сообщение. Пожалуйста, свяжитесь с администратором серивиса.',
    'email_confirm_success' => 'Ваш адрес электронной почты был подтвержден!',
    'email_confirm_resent' => 'Письмо с подтверждением электронной почты было отпавлено повторно, пожалуйста, проверьте ваш почтовый ящик.',

    'email_not_confirmed' => 'Адрес электронной почты не подтверждён.',
    'email_not_confirmed_text' => 'Ваш адрес электронной почты не был пока подтверждён.',
    'email_not_confirmed_click_link' => 'Пожалуйста, нажмите по ссылке, отправленной вам в письмо при регистрации.',
    'email_not_confirmed_resend' => 'Если вы не можете найти данное письмо, вы можете перевыслать подтверждение заполнив форму, расположенную ниже.',
    'email_not_confirmed_resend_button' => 'Отправить потверждение повторно.',
];
