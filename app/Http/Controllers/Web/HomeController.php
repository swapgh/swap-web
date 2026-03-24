<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        require_once dirname(__DIR__, 3) . '/Content/Pages/home.php';

        $pageContent = build_home_page_content($GLOBALS['pageLang'], $GLOBALS['site']);

        $this->renderPage('web.pages.public.home', ['home' => $pageContent]);
    }

    public function notFound(): void
    {
        $this->renderPage('web.pages.public.error-404');
    }
}
