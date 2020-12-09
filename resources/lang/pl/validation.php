<?php

return [
    'fields' => [
        'email' => 'e-mail',
        'password' => 'hasło',
        'name' => 'imię',
        'last_name' => 'nazwisko',
        'username' => 'nazwa użytkownika',
        'birthday' => 'data urodzenia',
        'sex' => 'płeć',
        'country' => 'kraj',
        'city' => 'miasto',
        'address' => 'adres',
        'post_code' => 'kod pocztowy',
        'contact_phone' => 'numer telefonu',
        '_name' => 'nazwa',
        'is_private' => 'czy prywatne',
        'is_visibility' => 'czy publiczne',
        'photos' => 'zdjęcia',
        'comment' => 'komentarz',
        'comment_reply' => 'odpowiedź na komentarz',
        'title' => 'tytuł',
        'category_id' => 'kategoria',
        'is_comment' => 'czy można komentować',
        'is_rating' => 'czy można oceniać',
        'old_password' => 'obecne hasło',
        'new_password' => 'nowe hasło'
    ],
    'required' => 'Pole :var jest wymagane',
    'required_file' => 'Nie wybrano pliku',
    'required_rating' => 'Proszę wybrać ocenę',
    'email' => 'Wpisz prawidłowy adres email',
    'min' => 'Pole :var musi zawierać co najmniej :val znaków',
    'max' => 'Pole :var może zawierać maksymalnie :val znaków',
    'string' => 'Pole :var musi być ciągiem znaków',
    'unique' => [
        'username' => 'Wpisana nazwa użytkownika jest już w użyciu',
    ],
    'date_format' => 'Wpisana data jest nieprawidłowa',
    'integer' => 'Pole :var jest nieprawidłowe. Wybierz wartość z listy',
    'array' => 'Pole :var musi być tablicą. Odśwież stronę i spróbuj ponownie',
    'mimes' => 'Przekazano niewałaściwy plik. Dostępne rozszerzenia (:val)'
];
