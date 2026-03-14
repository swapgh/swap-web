<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class HomeController extends Controller
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/pages/home-content.php';
        $home = home_content($GLOBALS['pageLang'], $GLOBALS['site']);
        $this->render('pages.home', ['home' => $home]);
    }

    public function milestone(string $slug): void
    {
        $this->render('devlog.' . $slug, ['milestoneSlug' => $slug]);
    }

    public function notFound(): void
    {
        $this->render('pages.404');
    }
}
