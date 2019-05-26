<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class AuthenticateAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function handle($request, Closure $next)
    {
        $validSecrets = explode(',', env('ACCEPTED_SECRETS'));
        
        // Auth not working properly - below code is for testing/debugging
        // echo sizeof($validSecrets);
        // $ddbtest  = $request->header('Authorization');
        // echo '<script>console.log("cons log output check :', $ddbtest, '")</script>' ;
        // // for ($i=0; $i<sizeof($validSecrets); $i++) {
        //     echo $validSecrets[$i];
        // }

        if (in_array($request->header('Authorization'), $validSecrets)) {
            return $next($request);
        }

        abort(Response::HTTP_UNAUTHORIZED);
    }
}