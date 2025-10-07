<?php

return [

    'column_manager' => [

        'heading' => 'Kolommen',

        'actions' => [

            'apply' => [
                'label' => 'Kolommen toepassen',
            ],

            'reset' => [
                'label' => 'Resetten',
            ],

        ],

    ],

    'columns' => [

        'actions' => [
            'label' => 'Actie|Acties',
        ],

        'select' => [

            'loading_message' => 'Laden...',

            'no_search_results_message' => 'Geen opties komen overeen met je zoekopdracht.',

            'placeholder' => 'Selecteer een optie',

            'searching_message' => 'Zoeken...',

            'search_prompt' => 'Begin met typen om te zoeken...',

        ],

        'text' => [

            'actions' => [
                'collapse_list' => ':count minder tonen',
                'expand_list' => ':count meer tonen',
            ],

            'more_list_items' => 'en :count meer',
        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Alle items selecteren/deselecteren voor bulkacties.',
        ],

        'bulk_select_record' => [
            'label' => 'Item :key selecteren/deselecteren voor bulkacties.',
        ],

        'bulk_select_group' => [
            'label' => 'Groep :title selecteren/deselecteren voor bulkacties.',
        ],

        'search' => [
            'label' => 'Zoeken',
            'placeholder' => 'Zoeken',
            'indicator' => 'Zoekopdracht',
        ],

    ],

    'summary' => [

        'heading' => 'Samenvatting',

        'subheadings' => [
            'all' => 'Alle :label',
            'group' => ':group samenvatting',
            'page' => 'Deze pagina',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Gemiddelde',
            ],

            'count' => [
                'label' => 'Aantal',
            ],

            'sum' => [
                'label' => 'Som',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Herordenen van records voltooien',
        ],

        'enable_reordering' => [
            'label' => 'Records herordenen',
        ],

        'filter' => [
            'label' => 'Filteren',
        ],

        'group' => [
            'label' => 'Groeperen',
        ],

        'open_bulk_actions' => [
            'label' => 'Acties openen',
        ],

        'column_manager' => [
            'label' => 'Kolommen in-/uitschakelen',
        ],

    ],

    'empty' => [

        'heading' => 'Geen :model',

        'description' => 'Maak een :model aan om aan de slag te gaan.',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'Filters toepassen',
            ],

            'remove' => [
                'label' => 'Filter verwijderen',
            ],

            'remove_all' => [
                'label' => 'Alle filters verwijderen',
                'tooltip' => 'Alle filters verwijderen',
            ],

            'reset' => [
                'label' => 'Resetten',
            ],

        ],

        'heading' => 'Filters',

        'indicator' => 'Actieve filters',

        'multi_select' => [
            'placeholder' => 'Alles',
        ],

        'select' => [

            'placeholder' => 'Alles',

            'relationship' => [
                'empty_option_label' => 'Geen',
            ],
        ],

        'trashed' => [

            'label' => 'Verwijderde records',

            'only_trashed' => 'Alleen verwijderde records',

            'with_trashed' => 'Met verwijderde records',

            'without_trashed' => 'Zonder verwijderde records',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Groeperen op',
            ],

            'direction' => [

                'label' => 'Groeperingsrichting',

                'options' => [
                    'asc' => 'Oplopend',
                    'desc' => 'Aflopend',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Sleep de records in de juiste volgorde.',

    'selection_indicator' => [

        'selected_count' => '1 record geselecteerd|:count records geselecteerd',

        'actions' => [

            'select_all' => [
                'label' => 'Selecteer alle :count',
            ],

            'deselect_all' => [
                'label' => 'Alles deselecteren',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Sorteren op',
            ],

            'direction' => [

                'label' => 'Sorteerrichting',

                'options' => [
                    'asc' => 'Oplopend',
                    'desc' => 'Aflopend',
                ],

            ],

        ],

    ],

    'default_model_label' => 'record',

];
