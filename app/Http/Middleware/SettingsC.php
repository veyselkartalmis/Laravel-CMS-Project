<?php

namespace App\Http\Middleware;

use App\Settings;
use Closure;
use Illuminate\Support\Facades\View;

class SettingsC
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
        $data["settings"] = Settings::all();
        foreach($data["settings"] as $key){
            $settings[$key->settings_key] = $key->settings_value;
        }
        View::share($settings);
        return $next($request);
    }
}
