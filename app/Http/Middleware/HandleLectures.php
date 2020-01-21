<?php

namespace App\Http\Middleware;

use Closure;

class HandleLectures
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
        $sessions = collect($request->data);

        $sessions = $sessions->map(function ($item) {
            $item = preg_replace('/lightning/', '5min', $item);

            return $item;
        });

        $sessions = $sessions->map(function ($item) {
            preg_match('/[0-9]{1,2}/', $item, $matches);

            $name = preg_replace('/\s[0-9]{1,2}min/', '', $item);

            return ['duration' => $matches[0], 'name' => $name];
        });

       $request->data = $sessions;

        return $next($request);
    }
}
