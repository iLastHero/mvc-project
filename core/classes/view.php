<?php

class View
{
    private $templatePath = null;
    private $viewPath;
    
    public function __construct($view = null, $template = null)
    {
        if($view != null)
        {
            $this->viewPath = VIEWS_PATH.DS.$view.'.php';
        }
        else
        {
            $this->viewPath = VIEWS_PATH.DS.app::getRouter()->getController().'.php';
        }
        
        if($template != null)
        {
            $this->templatePath = TEMPLATE_PATH.DS.$template.'.php';
        }
    }
    
    private function renderTemplate()
    {
        ob_start();
        $this->renderDefault();
        
        $content = ob_get_clean();
        
        if(file_exists($this->templatePath))
        {
            require $this->templatePath;
        }
    }
    
    private function renderDefault()
    {
        if(file_exists($this->viewPath))
        {
            require $this->viewPath;
        }
    }
    
    public function render()
    {
        if ($this->templatePath != null)
        {
            $this->renderTemplate();
        }
        else
        {
            $this->renderDefault();
        }
    }
}