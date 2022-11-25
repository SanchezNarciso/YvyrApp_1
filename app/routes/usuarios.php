<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

require_once __DIR__ . '/../config/database.php';

return function (App $app) {
    
    $app->group('/api/usuarios', function (Group $group) {
        $group->post('/login', function (Request $request, Response $response) {
            
            try {
                $body = $request->getParsedBody();
                $usuario = $body['usuario'];
                $clave = $body['clave'];
                $conexion = new Conexion();
                $mysql = $conexion->conectar();

                

                $sql = "SELECT * FROM usuarios WHERE usuario=? AND clave=?";
                $stmt = $mysql->prepare($sql);
                $stmt->bindParam(1, $usuario, PDO::PARAM_STR);
                $stmt->bindParam(2, $clave, PDO::PARAM_STR);
                $data = array();
                if ($stmt->execute()) {
                    $data = $stmt->fetchAll(PDO::FETCH_OBJ);
                }
                $arr = array('status' => 404, 'msg' => 'No existen registros.', 'data' => $data);
                if (count($data) > 0) {
                    $data[0]->clave = '*****';
                    $arr = array('status' => 200, 'msg' => 'Datos encontrados.', 'data' => $data);
                }
                $json = json_encode($arr);
                $response->getBody()->write($json);
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200, $reasonPhrase = '');
            } catch (Exception $e) {
                $data = array();
                $arr = array('status' => 404, 'msg' => 'No existen registros.', 'data' => $data);
                $json = json_encode($arr);
                $response->getBody()->write($json);
                return $response->withHeader('Content-Type', 'application/json')->withStatus(200, $reasonPhrase = '');
            }
        });
    });
};
