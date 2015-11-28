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

    'accepted'             => 'A(z) :attribute el kell fogadni.',
    'active_url'           => 'A(z) :attribute nem egy létező URL.',
    'after'                => 'A(z) :attribute egy dátumnak kell lennie, :date után.',
    'alpha'                => 'A(z) :attribute csak betűket tartalmazhat.',
    'alpha_dash'           => 'A(z) :attribute csak betűket, számokat és kötőjeleket tartalmazhat.',
    'alpha_num'            => 'A(z) :attribute csak betűket és számokat tartalmazhat.',
    'alpha_spaces'         => 'A(z) :attribute csak betűket és space-eket tartalmazhat.',
    'array'                => 'A(z) :attribute egy tömbnek kell lennie.',
    'before'               => 'A(z) :attribute egy dátumnak kell lennie, :date előtt.',
    'between'              => [
        'numeric' => 'A(z) :attribute mezőnek a következő értékek között kell lennie: :min és :max.',
        'file'    => 'A(z) :attribute mérete :min és :max kilobyte közötti lehet.',
        'string'  => 'A(z) :attribute :min és :max karakter közötti lehet.',
        'array'   => 'A(z) :attribute :min és :max közötti adatot tartalmazhat.',
    ],
    'boolean'              => 'A(z) :attribute mező igaz vagy hamis lehet.',
    'confirmed'            => 'A(z) :attribute megerősítése nem megfelelő.',
    'date'                 => 'A(z) :attribute nem egy valós dátum.',
    'date_format'          => 'A(z) :attribute nem felel meg a következő formátumnak: :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'The :attribute must be :digits digits.',
    'digits_between'       => 'The :attribute must be between :min and :max digits.',
    'email'                => 'A(z) :attribute mezőben egy valós e-mail címet kell megadni.',
    'exists'               => 'The selected :attribute is invalid.',
    'filled'               => 'The :attribute field is required.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => 'The selected :attribute is invalid.',
    'integer'              => 'A(z) :attribute egy egész számnak kell lennie.',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file'    => 'The :attribute may not be greater than :max kilobytes.',
        'string'  => 'The :attribute may not be greater than :max characters.',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'A(z) :attribute legalább :min karakter hosszúságú legyen.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'A(z) :attribute mező kitöltése kötelező.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'A(z) :attribute nem egy karaktersorozat.',
    'timezone'             => 'A(z) :attribute nem egy valós név.',
    'unique'               => 'A(z) :attribute már foglalt.',
    'url'                  => 'A(z) :attribute formátuma helytelen.',
    'date_multi_format'    => 'Nem megfelelő időformátum. A helyes formátum a következő: pp:mm.ss - pl.:02:30.00',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
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

    'attributes' => [
        'name' => 'Név',
        'password' => 'Jelszó',
        'country' => 'Ország',
        'town' => 'Város',
        'sex' => 'Nem',
        'colour' => 'Szín',
        'age' => 'Kor',
        'swimming_time' => 'Úszóidő 250 ponthoz',
        'ce_time' => 'Kombinált idő 500 ponthoz',
        'swimming_dist' => 'Úszás hossza',
        'ce_dist' => 'Kombinált hossza',
        'role' => 'Szerep',
        'bouts_250' => '250 ponthoz szükséges tusok száma',
        'victory_points' => 'Győzelem pontszáma',
        'first_name' => 'Keresztnév',
        'last_name' => 'Vezetéknév',
        'birthday' => 'Születési idő',
        'country_id' => 'Ország',
        'club' => 'Klub',
        'host' => 'Rendező',
        'start_date' => 'Verseny kezdete',
        'end_date' => 'Versenyy vége',
        'category' => 'Kategória',
        'competition_id' => 'Verseny',
        'type' => 'Típus',
        'age_group' => 'Korosztály',
        'fencing_bouts' => 'Összes tus száma',
        'competitors' => 'Versenyző',
        'team_name' => 'Név'

    ],

];
