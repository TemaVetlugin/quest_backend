<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class BlockMiddleware
{
    public function handle($request, Closure $next)
    {
        // Ваш код middleware
        $user=auth()->user();
        if ($user && $user->access===0) {
            // Если пользователь не аутентифицирован, выполняем редирект на маршрут API
            return response( 'Ваш аккаунт заблокирован', 401);
        }
        return $next($request);
    }
}
