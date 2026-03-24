<?php
declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Core\Controller;
use App\Support\PageCatalog;

final class PublicPageController extends Controller
{
    public function show(string $slug): void
    {
        require_once dirname(__DIR__, 3) . '/Content/Pages/public-pages.php';

        $pageDefinition = PageCatalog::findBySlug($slug);
        if ($pageDefinition === null) {
            http_response_code(404);
            (new HomeController())->notFound();
            return;
        }

        $pageContent = build_site_page_content($slug, $GLOBALS['pageLang'], $GLOBALS['site']);

        $this->renderPage('web.pages.public.content-page', [
            'page' => $pageContent,
            'pageSlug' => $slug,
            'pagePath' => (string) ($pageDefinition['path'] ?? ''),
        ]);
    }
}
