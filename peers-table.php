<?php

function render_peer_table($sync_data){
    $html = get_peer_table_header();
    $html .= generate_peer_table_body($sync_data);
    $html .= get_close_peer_table();
    return $html;
}

function get_peer_table_header()
{
    $style = get_table_style();
    return <<<HTML
        {$style}
        <table class="sync-table">
            <thead>
                <tr>
                    <td>Node ID</td>
                    <td># Bad syncs</td>
                    <td># Peers</td>
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

function generate_peer_table_body($sync_data)
{
    $html = "";
    foreach ($sync_data as $peer_id => $peer) {
        $connected_peers_count = count($peer['peers']);
        $url_encoded_peer_id = urlencode($peer_id);
        $html .= <<<HTML
                <tr>
                    <td>{$peer_id}</td>
                    <td>{$peer['bad_syncs']}</td>
                    <td><a href="?peer_id={$url_encoded_peer_id}">{$connected_peers_count}</a></td>
                </tr>
HTML;
    }
    return $html;
}

function get_close_peer_table()
{
    return <<<HTML
            </tbody>
        </table>
HTML;
}

