<?php


namespace App\Controllers;
use App\Core\System;
use App\Core\Traits\ResourceController;
use App\Models\Tour;

class TourController extends AdminController {

    use ResourceController;

    protected $sideBar;
    protected $model;
    protected $name = 'tour';

    public function __construct () {
        parent::__construct();
        $this->indexTemplate = $this->name . '-index';

        $this->sideBar = System::buildTemplate($this->getTemplateName('side-bar'), [
            'msg' => $_SESSION['msg'] ?? ''
        ]);
        unset($_SESSION['msg']);

        $this->model = Tour::getInstance();
    }

    protected function manageFormData () {
        $request = [];

        if (count($_POST) > 0) {
            foreach ($_POST as $key => $value) {
                $request[$key] = htmlspecialchars($value);
            }

            $request['is_available'] = $_POST['is_available'] ?? 0;
            unset($request['button']);
        }

        return $request;
    }
}