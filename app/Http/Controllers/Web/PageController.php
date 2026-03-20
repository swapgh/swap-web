<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;

final class PageController extends Controller
{
    public function project(): void
    {
        $this->renderPage('project');
    }

    public function contact(): void
    {
        $this->renderPage('contact');
    }

    public function help(): void
    {
        $this->renderPage('help');
    }

    public function store(): void
    {
        $this->renderPage('store');
    }

    public function legalNotice(): void
    {
        $this->renderPage('legal-notice');
    }

    public function privacy(): void
    {
        $this->renderPage('privacy');
    }

    public function cookies(): void
    {
        $this->renderPage('cookies');
    }

    public function paymentDisclaimer(): void
    {
        $this->renderPage('payment-disclaimer');
    }

    public function supportTerms(): void
    {
        $this->renderPage('support-terms');
    }

    public function classSelect(): void
    {
        $this->renderPage('class-select');
    }

    public function combatSlice(): void
    {
        $this->renderPage('combat-slice');
    }

    public function darkBiome(): void
    {
        $this->renderPage('dark-biome');
    }

    public function rogueBuild(): void
    {
        $this->renderPage('rogue-build');
    }

    public function liminalZone(): void
    {
        $this->renderPage('liminal-zone');
    }

    private function renderPage(string $slug): void
    {
        require_once dirname(__DIR__, 3) . '/Content/Web/site-pages.php';

        $pageContent = build_site_page_content($slug, $GLOBALS['pageLang'], $GLOBALS['site']);

        $this->render('web.pages.page', [
            'page' => $pageContent,
            'pageSlug' => $slug,
        ]);
    }
}
