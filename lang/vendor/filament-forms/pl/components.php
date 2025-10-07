<?php

return [

    'builder' => [

        'actions' => [

            'clone' => [
                'label' => 'Duplikuj',
            ],

            'add' => [

                'label' => 'Dodaj do :label',

                'modal' => [

                    'heading' => 'Dodaj do :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Dodaj',
                        ],

                    ],

                ],

            ],

            'add_between' => [

                'label' => 'Wstaw pomiędzy',

                'modal' => [

                    'heading' => 'Dodaj do :label',

                    'actions' => [

                        'add' => [
                            'label' => 'Dodaj',
                        ],

                    ],

                ],

            ],

            'delete' => [
                'label' => 'Usuń',
            ],

            'edit' => [

                'label' => 'Edytuj',

                'modal' => [

                    'heading' => 'Edytuj blok',

                    'actions' => [

                        'save' => [
                            'label' => 'Zapisz zmiany',
                        ],

                    ],

                ],

            ],

            'reorder' => [
                'label' => 'Przesuń',
            ],

            'move_down' => [
                'label' => 'Przesuń w dół',
            ],

            'move_up' => [
                'label' => 'Przesuń w górę',
            ],

            'collapse' => [
                'label' => 'Zwiń',
            ],

            'expand' => [
                'label' => 'Rozwiń',
            ],

            'collapse_all' => [
                'label' => 'Zwiń wszystko',
            ],

            'expand_all' => [
                'label' => 'Rozwiń wszystko',
            ],

        ],

    ],

    'checkbox_list' => [

        'actions' => [

            'deselect_all' => [
                'label' => 'Odznacz wszystkie',
            ],

            'select_all' => [
                'label' => 'Zaznacz wszystkie',
            ],

        ],

    ],

    'file_upload' => [

        'editor' => [

            'actions' => [

                'cancel' => [
                    'label' => 'Anuluj',
                ],

                'drag_crop' => [
                    'label' => 'Tryb przeciągania "przytnij"',
                ],

                'drag_move' => [
                    'label' => 'Tryb przeciągania "przenieś"',
                ],

                'flip_horizontal' => [
                    'label' => 'Odwróć obraz poziomo',
                ],

                'flip_vertical' => [
                    'label' => 'Odwróć obraz pionowp',
                ],

                'move_down' => [
                    'label' => 'Przenieś obraz w dół',
                ],

                'move_left' => [
                    'label' => 'Przenieś obraz w lewo',
                ],

                'move_right' => [
                    'label' => 'Przenieś obraz w prawo',
                ],

                'move_up' => [
                    'label' => 'Przenieś obraz w górę',
                ],

                'reset' => [
                    'label' => 'Zresetuj',
                ],

                'rotate_left' => [
                    'label' => 'Obróć obraz w lewo',
                ],

                'rotate_right' => [
                    'label' => 'Obróć obraz w prawo',
                ],

                'set_aspect_ratio' => [
                    'label' => 'Zmień proporcje na :ratio',
                ],

                'save' => [
                    'label' => 'Zapisz',
                ],

                'zoom_100' => [
                    'label' => 'Przybliż obraz do 100%',
                ],

                'zoom_in' => [
                    'label' => 'Przybliż',
                ],

                'zoom_out' => [
                    'label' => 'Oddal',
                ],

            ],

            'fields' => [

                'height' => [
                    'label' => 'Wysokość',
                    'unit' => 'px',
                ],

                'rotation' => [
                    'label' => 'Obrót',
                    'unit' => 'deg',
                ],

                'width' => [
                    'label' => 'Szerokość',
                    'unit' => 'px',
                ],

                'x_position' => [
                    'label' => 'X',
                    'unit' => 'px',
                ],

                'y_position' => [
                    'label' => 'Y',
                    'unit' => 'px',
                ],

            ],

            'aspect_ratios' => [

                'label' => 'Proporcje',

                'no_fixed' => [
                    'label' => 'Dowolnie',
                ],

            ],

            'svg' => [

                'messages' => [
                    'confirmation' => 'Edycja plików SVG nie jest zalecana, ponieważ może to prowadzić do utraty jakości podczas skalowania.\n Czy na pewno chcesz kontynuować?',
                    'disabled' => 'Edycja plików SVG jest wyłączona, ponieważ może to prowadzić do utraty jakości podczas skalowania.',
                ],

            ],

        ],

    ],

    'key_value' => [

        'actions' => [

            'add' => [
                'label' => 'Dodaj wiersz',
            ],

            'delete' => [
                'label' => 'Usuń wiersz',
            ],

            'reorder' => [
                'label' => 'Przenieś wiersz',
            ],

        ],

        'fields' => [

            'key' => [
                'label' => 'Klucz',
            ],

            'value' => [
                'label' => 'Wartość',
            ],

        ],

    ],

    'markdown_editor' => [

        'tools' => [
            'attach_files' => 'Dołącz pliki',
            'blockquote' => 'Cytat blokowy',
            'bold' => 'Pogrubienie',
            'bullet_list' => 'Lista punktowana',
            'code_block' => 'Blok kodu',
            'heading' => 'Nagłówek',
            'italic' => 'Kursywa',
            'link' => 'Adres',
            'ordered_list' => 'Lista numerowana',
            'redo' => 'Ponów',
            'strike' => 'Przekreślenie',
            'table' => 'Tabela',
            'undo' => 'Cofnij',
        ],

    ],

    'modal_table_select' => [

        'actions' => [

            'select' => [

                'label' => 'Wybierz',

                'actions' => [

                    'select' => [
                        'label' => 'Wybierz',
                    ],

                ],

            ],

        ],

    ],

    'radio' => [

        'boolean' => [
            'true' => 'Tak',
            'false' => 'Nie',
        ],

    ],

    'repeater' => [

        'actions' => [

            'add' => [
                'label' => 'Dodaj do :label',
            ],

            'add_between' => [
                'label' => 'Dodaj pomiędzy',
            ],

            'delete' => [
                'label' => 'Usuń',
            ],

            'clone' => [
                'label' => 'Duplikuj',
            ],

            'reorder' => [
                'label' => 'Przesuń',
            ],

            'move_down' => [
                'label' => 'Przesuń w dół',
            ],

            'move_up' => [
                'label' => 'Przesuń w górę',
            ],

            'collapse' => [
                'label' => 'Zwiń',
            ],

            'expand' => [
                'label' => 'Rozwiń',
            ],

            'collapse_all' => [
                'label' => 'Zwiń wszystko',
            ],

            'expand_all' => [
                'label' => 'Rozwiń wszystko',
            ],

        ],

    ],

    'rich_editor' => [

        'actions' => [

            'attach_files' => [

                'label' => 'Prześlij plik',

                'modal' => [

                    'heading' => 'Prześlij plik',

                    'form' => [

                        'file' => [

                            'label' => [
                                'new' => 'Plik',
                                'existing' => 'Zastąp plik',
                            ],

                        ],

                        'alt' => [

                            'label' => [
                                'new' => 'Tekst alternatywny',
                                'existing' => 'Zmień tekst alternatywny',
                            ],

                        ],

                    ],

                ],

            ],

            'custom_block' => [

                'modal' => [

                    'actions' => [

                        'insert' => [
                            'label' => 'Wstaw',
                        ],

                        'save' => [
                            'label' => 'Zapisz',
                        ],

                    ],

                ],

            ],

            'link' => [

                'label' => 'Edytuj',

                'modal' => [

                    'heading' => 'Link',

                    'form' => [

                        'url' => [
                            'label' => 'URL',
                        ],

                        'should_open_in_new_tab' => [
                            'label' => 'Otwórz w nowej karcie',
                        ],

                    ],

                ],

            ],

        ],

        'no_merge_tag_search_results_message' => 'Brak wyników.',

        'tools' => [
            'align_center' => 'Wyśrodkuj',
            'align_end' => 'Wyrównaj do prawej',
            'align_justify' => 'Justuj',
            'align_start' => 'Wyrównaj do lewej',
            'attach_files' => 'Dołącz pliki',
            'blockquote' => 'Cytat',
            'bold' => 'Pogrubienie',
            'bullet_list' => 'Lista punktowana',
            'clear_formatting' => 'Usuń formatowanie',
            'code_block' => 'Blok kodu',
            'custom_blocks' => 'Bloki',
            'details' => 'Szczegóły',
            'highlight' => 'Podświetlenie',
            'horizontal_rule' => 'Linia pozioma',
            'h1' => 'Tytuł',
            'h2' => 'Nagłówek',
            'h3' => 'Podtytuł',
            'italic' => 'Kursywa',
            'lead' => 'Tekst wiodący',
            'link' => 'Adres',
            'merge_tags' => 'Scal tagi',
            'ordered_list' => 'Lista numerowana',
            'redo' => 'Ponów',
            'small' => 'Mniejsza czcionka',
            'strike' => 'Przekreślenie',
            'subscript' => 'Indeks dolny',
            'superscript' => 'Indeks górny',
            'table' => 'Tabela',
            'table_delete' => 'Usuń tabelę',
            'table_add_column_before' => 'Dodaj kolumnę przed',
            'table_add_column_after' => 'Dodaj kolumnę po',
            'table_delete_column' => 'Usuń kolumnę',
            'table_add_row_before' => 'Dodaj wiersz powyżej',
            'table_add_row_after' => 'Dodaj wiersz poniżej',
            'table_delete_row' => 'Usuń wiersz',
            'table_merge_cells' => 'Scal komórki',
            'table_split_cell' => 'Podziel komórkę',
            'table_toggle_header_row' => 'Przełącz wiersz nagłówka',
            'underline' => 'Podkreślenie',
            'undo' => 'Cofnij',
        ],

    ],

    'select' => [

        'actions' => [

            'create_option' => [

                'label' => 'Utwórz',

                'modal' => [

                    'heading' => 'Utwórz',

                    'actions' => [

                        'create' => [
                            'label' => 'Utwórz',
                        ],

                        'create_another' => [
                            'label' => 'Utwórz i utwórz kolejny',
                        ],

                    ],

                ],

            ],

            'edit_option' => [

                'label' => 'Edytuj',

                'modal' => [

                    'heading' => 'Edytuj',

                    'actions' => [

                        'save' => [
                            'label' => 'Zapisz',
                        ],

                    ],

                ],

            ],

        ],

        'boolean' => [
            'true' => 'Tak',
            'false' => 'Nie',
        ],

        'loading_message' => 'Wczytywanie...',

        'max_items_message' => 'Można wybrać tylko :count elementów.',

        'no_search_results_message' => 'Żadne wyniki nie pasują do Twojego wyszukiwania.',

        'placeholder' => 'Wybierz z listy',

        'searching_message' => 'Szukanie...',

        'search_prompt' => 'Zacznij pisać aby wyszukać...',

    ],

    'tags_input' => [
        'placeholder' => 'Nowy tag',
    ],

    'text_input' => [

        'actions' => [

            'hide_password' => [
                'label' => 'Ukryj hasło',
            ],

            'show_password' => [
                'label' => 'Pokaż hasło',
            ],

        ],

    ],

    'toggle_buttons' => [

        'boolean' => [
            'true' => 'Tak',
            'false' => 'Nie',
        ],

    ],

];
