<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute должно быть принято.',
    'active_url'           => ':attribute не действительная ссылка.',
    'after'                => ':attribute должно быть датой после :date.',
    'alpha'                => ':attribute может содержать только буквы.',
    'alpha_dash'           => ':attribute может содержать только буквы, цифры и тире.',
    'alpha_num'            => ':attribute может содержать только буквы и цифры.',
    'array'                => ':attribute должно быть массивом.',
    'before'               => ':attribute должно быть датой до :date.',
    'between'              => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file'    => ':attribute должно быть между :min и :max килобайт.',
        'string'  => ':attribute должно быть между :min и :max символов.',
        'array'   => ':attribute должно быть между :min и :max штук.',
    ],
    'boolean'              => ':attribute должно быть true или false.',
    'confirmed'            => ':attribute подтверждение не совпадает.',
    'date'                 => ':attribute не корректная дата.',
    'date_format'          => ':attribute не совпадает с форматом :format.',
    'different'            => ':attribute и :other должны быть разными.',
    'digits'               => ':attribute должно быть длиной в :digits цифр.',
    'digits_between'       => ':attribute должно быть между :min и :max цифр.',
    'email'                => ':attribute должен быть действующим адресом электронной почты.',
    'filled'               => ':attribute поле необходимо.',
    'exists'               => 'выбранный :attribute не существует.',
    'image'                => ':attribute должно быть изображением.',
    'in'                   => 'выбранный :attribute не действителен.',
    'integer'              => ':attribute должно быть целым числом.',
    'ip'                   => ':attribute должно быть действительным IP адресом.',
    'max'                  => [
        'numeric' => ':attribute не может быть больше :max.',
        'file'    => ':attribute не может быть больше :max килобайт.',
        'string'  => ':attribute не может быть больше :max символов.',
        'array'   => ':attribute не может содержать больше :max штук.',
    ],
    'mimes'                => ':attribute должен быть файлом типа: :values.',
    'min'                  => [
        'numeric' => ':attribute не может быть меньше :max.',
        'file'    => ':attribute не может быть меньше :max килобайт.',
        'string'  => ':attribute не может быть меньше :max символов.',
        'array'   => ':attribute не может содержать меньше :max штук.',
    ],
    'not_in'               => 'Выбраный :attribute не корректен.',
    'numeric'              => ':attribute должно быть числом.',
    'regex'                => ':attribute формат не корректен.',
    'required'             => ':attribute поле необходимо.',
    'required_if'          => ':attribute поле необходимо, когда :other установлено в :value.',
    'required_with'        => ':attribute поле необходимо, когда :values установлено.',
    'required_with_all'    => ':attribute поле необходимо, когда :values установлено.',
    'required_without'     => ':attribute поле необходимо, когда :values не установлено.',
    'required_without_all' => ':attribute поле необходимо, когда ни одно из :values не остановлено.',
    'same'                 => ':attribute и :other должны совпадать.',
    'size'                 => [
        'numeric' => ':attribute должно быть равным :size.',
        'file'    => ':attribute должно быть равным :size килобайт.',
        'string'  => ':attribute должно содержать :size символов.',
        'array'   => ':attribute должно содержать :size штук.',
    ],
    'string'               => ':attribute должно быть строкой.',
    'timezone'             => ':attribute должно быть корректной зоной.',
    'unique'               => ':attribute уже занят.',
    'url'                  => ':attribute формат не корректен.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'password-confirm' => [
            'required_with' => 'Необходимо подтверждение пароля',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
