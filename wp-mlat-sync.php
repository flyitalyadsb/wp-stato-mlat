<?php
/**
 * Plugin Name: wp-mlat-sync
 */

include_once 'config.php';

add_shortcode('wp-mlat-sync-table', 'render_table');

function render_table($atts = [], $content = null)
{
    $sync_data = load_sync_data();
    $html .= get_table_header();
    $html .= generate_table_body($sync_data);
    $html .= get_close_table();
    return $html;
}


function load_sync_data()
{
    $file_content = file_get_contents(MLAT_SERVER_WORKDIR . "/sync.json");
    return json_decode($file_content, true);
}

function get_table_header()
{
    $style = get_table_style();
    return <<<HTML
        {$style}
        <table class="sync-table">
            <thead>
                <tr>
                    <td>Node ID</td>
                    <td># Peers</td>
                    <td># Bad syncs</td>
                    <td>Lat</td>
                    <td>Lon</td>
                </tr>
            </thead>
            <tbody>    
HTML;
}

function get_table_style() {
    return <<<HTML
        <style>
            .sync-table thead {
            font-weight: bold;
                background-color: #fcaf3b;
            }
        </style>
HTML;
}

function generate_table_body($sync_data)
{
    $html = "";
    foreach ($sync_data as $peer_id => $peer) {
        $connected_peers_count = count($peer['peers']);
        $html .= <<<HTML
                <tr>
                    <td>{$peer_id}</td>
                    <td>{$connected_peers_count}</td>
                    <td>{$peer['bad_syncs']}</td>
                    <td>{$peer['lat']}</td>
                    <td>{$peer['lon']}</td>
                </tr>
HTML;
    }
    return $html;
}

function get_close_table()
{
    return <<<HTML
            </tbody>
        </table>
HTML;
}
