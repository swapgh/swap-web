<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Core\Controller;

final class HealthController extends Controller
{
    public function show(): never
    {
        $this->json([
            'ok' => true,
            'service' => 'swap-web',
            'area' => 'api',
            'timestamp' => gmdate(DATE_ATOM),
        ]);
    }
}
