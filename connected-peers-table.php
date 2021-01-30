<?php

function render_connected_peers_table($sync_data, $peer_id){
    $html = "<h4>Peer '{$peer_id}'</h4>";
    if (!isset($sync_data[$peer_id])) {
        $html .= "<p>Peer non trovato</p>";
    } else {
        $peer = $sync_data[$peer_id];
        $html .= get_connected_peer_table_header();
        $html .= generate_connected_peer_table_body($peer['peers']);
        $html .= get_close_connected_peer_table();
    }
    $html .= "<a href='?'>Torna alla lista dei peer</a>";
    return $html;
}

function get_connected_peer_table_header () {
    return <<<HTML
        <div class="table-container">
            <table class="sync-table">
                <thead>
                    <tr>
                        <td>Node ID</td>
                        <td>Sync count</td>
                        <td>Sync error</td>
                        <td>PPM offset</td>
                        <td>Timeout</td>
                    </tr>
                </thead>
                <tbody>
HTML;
}

function generate_connected_peer_table_body ($peers) {
    $html = "";
    if (count($peers) <= 0) {
        $html .= "<tr><td colspan='4'><em>Nessun peer connesso</em></td></tr>";
    }
    foreach ($peers as $connected_peer_id => $connected_peer) {
        $html .= <<<HTML
                <tr>
                    <td>{$connected_peer_id}</td>
                    <td>{$connected_peer[0]}</td>
                    <td>{$connected_peer[1]}</td>
                    <td>{$connected_peer[2]}</td>
                    <td>{$connected_peer[3]}</td>
                </tr>
HTML;
    }
    return $html;
}

function get_close_connected_peer_table () {
    return <<<HTML
                </tbody>
            </table>
        </div>
HTML;
}