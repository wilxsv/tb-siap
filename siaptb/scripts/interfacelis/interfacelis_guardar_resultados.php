<?php
    ini_set('xdebug.var_display_max_depth', -1);
    ini_set('xdebug.var_display_max_children', -1);
    ini_set('xdebug.var_display_max_data', -1);

    include('librerias/Requests/library/Requests.php');
    include('configuracion.php');
    Requests::register_autoloader();

    $localPath = realpath(dirname(__FILE__)).'/../../../logs/interfacelis_guardar_resultados_'.date("y-m")."_";

    $session = new Requests_Session($dominio);
    $session->headers['Accept'] = 'application/json';
    $session->useragent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

    $now = new DateTime();

    try {
        $response = $session->get('app.php/api/checkin?user='.$user.'&password='.$password);

        if( $response->success ) {
            $responseData = json_decode($response->body, true);
            var_dump('---------CHECKIN---------');
            var_dump($responseData);

            $token = $responseData['token'];

            if( $token !== null && $token !== '' ) {
                $response = $session->get('app.php/api/laboratorio/resultados/equipoautomatizado/save?token='.$token);

                if( $response->success ) {
                    $responseData = $response->body;
                    var_dump('---------EQUIPO_AUTOMATIZADO_SAVE-----'.$now->format('d/m/Y H:i:s').'----');
                    var_dump($responseData);

                    file_put_contents($localPath.'log001.log', "Fecha Hora: ".$now->format('d/m/Y H:i:s')." - token: $token \n", FILE_APPEND);
                    file_put_contents($localPath.'log001.log', $responseData, FILE_APPEND);
                    file_put_contents($localPath.'log001.log', "\n\n", FILE_APPEND);

                    $response = $session->get('app.php/api/checkout?token='.$token);
                    if( $response->success ) {
                        $responseData = json_decode($response->body, true);
                        var_dump('---------CHECKOUT---------');
                        var_dump($responseData);
                    } else {
                        file_put_contents($localPath.'error001.log', "------------------------------------".$now->format('d/m/Y H:i:s')."------------------------------------\n", FILE_APPEND);
                        file_put_contents($localPath.'error001.log', "----------------------------------CHECKOUT---------------------------------\n", FILE_APPEND);
                        file_put_contents($localPath.'error001.log', $response, FILE_APPEND);
                        file_put_contents($localPath.'error001.log', "\n", FILE_APPEND);
                    }
                } else {
                    file_put_contents($localPath.'error001.log', "------------------------------------".$now->format('d/m/Y H:i:s')."------------------------------------\n", FILE_APPEND);
                    file_put_contents($localPath.'error001.log', "----------------------------------EQUIPO_AUTOMATIZADO_SAVE--------'.$now->format('d/m/Y H:i:s').'-------------------------\n", FILE_APPEND);
                    file_put_contents($localPath.'error001.log', $response, FILE_APPEND);
                    file_put_contents($localPath.'error001.log', "\n", FILE_APPEND);
                }
            } else {
                file_put_contents($localPath.'error001.log', "------------------------------------".$now->format('d/m/Y H:i:s')."------------------------------------\n", FILE_APPEND);
                file_put_contents($localPath.'error001.log', "----------------------------------CHECKIN---------------------------------\n", FILE_APPEND);
                file_put_contents($localPath.'error001.log', $response, FILE_APPEND);
                file_put_contents($localPath.'error001.log', "\n", FILE_APPEND);
            }
        }
    } catch (\Exception $e) {
        file_put_contents($localPath.'error001.log', "------------------------------------".$now->format('d/m/Y H:i:s')."------------------------------------\n", FILE_APPEND);
        file_put_contents($localPath.'error001.log', "----------------------------------EXCEPCION--------".$now->format('d/m/Y H:i:s')."-------------------------\n", FILE_APPEND);
        file_put_contents( $localPath.'error001.log', $e->__toString(), FILE_APPEND );
        file_put_contents( $localPath.'error001.log', "\n\n", FILE_APPEND );
    }
?>
