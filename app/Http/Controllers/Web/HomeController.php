<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        require_once dirname(__DIR__, 3) . '/Content/Web/home-page.php';

        $pageContent = build_home_page_content($GLOBALS['pageLang'], $GLOBALS['site']);

        $this->render('web.pages.home', ['home' => $pageContent]);
    }

    public function notFound(): void
    {
        $this->render('web.pages.404');
    }
}
