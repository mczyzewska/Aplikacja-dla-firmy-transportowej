<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Sprawdzamy czy użytkownik jest zalogowany i czy jego rola jest w dozwolonej liście
        if (!$request->user() || !in_array($request->user()->role, $roles)) {
            // Jeśli nie, wyrzucamy błąd 403 (Brak dostępu)
            abort(403, 'Nie masz uprawnień administratora do oglądania tej strony.');
        }

        return $next($request);
    }
}