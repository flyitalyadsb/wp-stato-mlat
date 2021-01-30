<?php
/**
 * Plugin Name: wp-mlat-sync
 */

include_once 'config.php';
include_once 'peers-table.php';
include_once 'connected-peers-table.php';

add_shortcode('wp-mlat-sync-table', 'render_table');

function render_table($atts = [], $content = null)
{
    $sync_data = load_sync_data();
    $html = get_table_style();
    if (isset($_GET['peer_id'])) {
        $html .= render_connected_peers_table($sync_data, $_GET['peer_id']);
    } else {
        $html .= render_peer_table($sync_data);
    }
    return $html;
}

function load_sync_data()
{
    $file_content = file_get_contents(MLAT_SERVER_WORKDIR . "/sync.json");
    return json_decode($file_content, true);
}

function get_table_style() {
    return <<<HTML
        <style>
            div.table-container {
                overflow-x: auto;
            }
            .sync-table thead {
                font-weight: bold;
                background-color: #fcaf3b;
            }
        </style>
HTML;
}
