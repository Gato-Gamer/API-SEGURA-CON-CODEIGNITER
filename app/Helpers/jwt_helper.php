<?php

use Config\Services;
use Firebase\JWT\JWT;
use App\Models\ModeloUsuario;
use CodeIgniter\Config\Services as ConfigServices;

function getJWTFromRequest($autentificacionHeader): string
{
    if (is_null($autentificacionHeader)) {
        throw new Exception('Faltante o invalido JWT en la solicitud');
    }

    return explode(' ', $autentificacionHeader)[1];
}

function validateJWTFromRequest(string $encodedToken)
{
    $key = Services::getSecretKey();
    $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
    $modeloUsuario = new ModeloUsuario();
    $modeloUsuario->buscarUsuarioPorEmail($decodedToken->email);
}

function getSignedJWTForUser(string $email): string
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration
    ];

    $jwt = JWT::encode($payload, Services::getSecretKey());// Solicita tres argumentos

    return $jwt;
}