<?php
    class Controller
    {
        protected $request;
        var $vars = [];
        public $layout = "default";
        protected $model;

        function __construct()
        {
            $this->request = new Request();
            Router::parse($this->request->url, $this->request);
            $tmp = rtrim(ucfirst($this->request->controller),"s");
            require(DIR_ROOT . 'Models/'.$tmp.'.php');
            $this->model = new $tmp($this);
        }

        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename)
        {
            extract($this->vars);
            ob_start();
            require(DIR_ROOT . "Views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
            $content_for_layout = ob_get_clean();

            if ($this->layout == false)
            {
                $content_for_layout;
            }
            else
            {
                require(DIR_ROOT . "Views/Layouts/" . $this->layout . '.php');
            }
        }

        function autoRender()
        {
            extract($this->vars);
            ob_start();
            require(DIR_ROOT . "Views/" . ucfirst($this->request->controller) . '/' . $this->request->action . '.php');
            $content_for_layout = ob_get_clean();
            if ($this->layout == false) $content_for_layout;
            else require(DIR_ROOT . "Views/Layouts/" . $this->layout . '.php');
        }

        /*private function secure_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        protected function secure_form($form)
        {
            foreach ($form as $key => $value)
            {
                $form[$key] = $this->secure_input($value);
            }
        }*/

    }
?>