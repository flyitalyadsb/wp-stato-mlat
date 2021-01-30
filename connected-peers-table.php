<?php

function render_connected_peers_table($sync_data, $peer_id){
    $html = "<h2>Peer '{$peer_id}'</h2>";
    $html = get_connected_peer_table_header();
    $html .= generate_connected_peer_table_body($sync_data);
    $html .= get_close_connected_peer_table();
    return $html;
}

function get_connected_peer_table_header () {

}

function generate_connected_peer_table_body () {

}

function get_close_connected_peer_table () {

}