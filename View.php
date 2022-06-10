<?php

class View {
    private $content = '';

    private function renderTemplate(string $action, array $data = []) { 
        $viewRoutes = include(ROOT . '/router/views.php');
        extract($data);
        ob_start();
        include '/var/www/html/views/' . $viewRoutes[$action];
        $content = ob_get_contents() . $content;
        ob_end_clean();
        return $content;
    }

    public function __construct(string $action = 'Error', $layoutData = [], $pageTemplateData = []) {
        $pageContent = $this->renderTemplate($action, $pageTemplateData);
        $layoutData['pageContent'] = $pageContent;
        $this->content = $this->renderTemplate('Layout', $layoutData);
    }
    
    public function getPageContent() {
        return $this->content;
    }
}