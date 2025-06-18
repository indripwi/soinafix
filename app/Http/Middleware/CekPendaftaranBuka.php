<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class CekPendaftaranBuka
{
    public function handle($request, Closure $next)
{
    logger('CekPendaftaranBuka dijalankan');

    $status = Setting::getValue('pendaftaran_status', 'tutup');
    if ($status !== 'buka') {
        return redirect()->route('pendaftaran.index')->with('error', 'Pendaftaran sedang ditutup.');
    }

    return $next($request);
}

}

