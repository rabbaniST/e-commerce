<?php 

namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function CreateToken($userEmail, $userID):string
    {
        $key = env('JWT_KEY');
        $playload= [
            'iss' => 'laravel-token',
            'iat' =>time(),
            'exp' =>time()+24*60*60,
            'userEmail'=> $userEmail,
            'userID'=> $userID
        ];

        return JWT::encode($key, $playload, 'HS256');
    }

    public static function ReadToken($token): string|object 
    {
        try{
            if($token == null){
                return 'Unauthenticated';
            }
            else{
                $key = env('JWT_KEY');
                $decoded = JWT::decode($token, new KEY('HS256'));
                return $decoded;
            }
        }
        catch(\Exception $e){
            return 'Unauthenticated';
        }
    }
}