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
    'different'            => 'A(z) :attribute és :other mezőnek különbözőnek kell lennie.',
    'digits'               => 'A(z) :attribute :digits számjegyűnek kell lennie.',
    'digits_between'       => 'A(z) :attribute :min és :max számjegy közöttinek kell lennie.',
    'email'                => 'A(z) :attribute mezőben egy valós e-mail címet kell megadni.',
    'exists'               => 'A választott :attribute nem létezik.',
    'filled'               => 'A(z) :attribute kitöltése kötelező.',
    'image'                => 'A(z) :attribute egy képnek kell lennie.',
    'in'                   => 'A(z) :attribute nem megfelelő.',
    'integer'              => 'A(z) :attribute egy egész számnak kell lennie.',
    'ip'                   => 'A(z) :attribute egy valódi IP-címnek kell lennie.',
    'json'                 => 'A(z) :attribute egy JSON stringnek kell lennie.',
    'max'                  => [
        'numeric' => 'A(z) :attribute értéke maximum ennyi lehet: :max.',
        'file'    => 'A(z) :attribute mérete nem lehet nagyobb :max kilobytenál.',
        'string'  => 'A(z) :attribute karaktereinek száma nem lehet több :max karakternél.',
        'array'   => 'A(z) :attribute nem tartalmazhat ennél több elemet: :max.',
    ],
    'mimes'                => 'A(z) :attribute típusa a következő lehet: :values.',
    'min'                  => [
        'numeric' => 'A(z) :attribute értékének minimum ennyinek kell lennie: :min.',
        'file'    => 'A(z) :attribute méretének minimuma :min kilobyte.',
        'string'  => 'A(z) :attribute legalább :min karakter hosszúságú legyen.',
        'array'   => 'A(z) :attribute nem tartalmazhat ennél kevesebb elemet: :min.',
    ],
    'not_in'               => 'A választott :attribute nem megfelelő.',
    'numeric'              => 'A(z) :attribute mezőben egy számot kell megadni.',
    'regex'                => 'A(z) :attribute formátuma nem megfelelő.',
    'required'             => 'A(z) :attribute mező kitöltése kötelező.',
    'required_if'          => 'A(z) :attribute mező kötelező, ha :other értéke :value.',
    'required_with'        => 'A(z) :attribute mező kötelező, ha :values létezik.',
    'required_with_all'    => 'A(z) :attribute mező kötelező, ha :values léteznek.',
    'required_without'     => 'A(z) :attribute mező kötelező, ha :values nem létezik.',
    'required_without_all' => 'A(z) :attribute mező kötelező, ha egyik :values sem létezik.',
    'same'                 => 'A(z) :attribute és :other meg kell egyeznie.',
    'size'                 => [
        'numeric' => 'A(z) :attribute mező méretének ennyinek kell lennie: :size.',
        'file'    => 'A(z) :attribute méretének ennyi kilobytenak kell lennie: :size.',
        'string'  => 'A(z) :attribute ennyi karaktert tartalmazhat: :size .',
        'array'   => 'A(z) :attribute ennyi elemet kell tartalmaznia: :size.',
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
        'team_name' => 'Név',
        'bouts_per_match' => 'Tusok száma meccsenként',
        'riding_time_limit' => 'Lovas szintidő',
        'club_id' => 'Klub',
        'date' => 'Dátum',
        'email' => 'E-mail'

    ],

];
