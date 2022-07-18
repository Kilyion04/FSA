<?php

/*
Plugin Name: PLugin RK
Plugin URI:
Description: Ceci est un plugin pour accéder à l'ajout de données dans la table
Author: Romary Kilyion
Version: 1.0
Author URI: https://github.com/Kilyion04/FSA.git
*/


add_action( 'elementor_pro/forms/new_record', function( $record, $ajax_handler  ) {
    $raw_fields = $record->get( 'fields' );
    $fields = [];
    foreach ( $raw_fields as $id => $field ) {
        $fields[ $id ] = $field['value'];
    }
    wp_remote_post( 'http://localhost/api/personnel/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/appareil/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/IP/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/imprimante/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/disque_dur/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/ecran/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/logiciel/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/PC/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/serveur/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/station_accueil/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/tablette/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/details/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/reseau/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/cartouche/create/create.php', [
        'body' => $fields,
    ]);
    wp_remote_post( 'http://localhost/api/logs/create/create.php', [
        'body' => $fields,
    ]);
}, 10, 2 );


