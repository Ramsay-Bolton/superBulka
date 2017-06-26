<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdminController
 *
 * @author user609
 */
class AdminController extends AdminBase {
    
    public function actionIndex() {
        
        self::checkAdmin();
        
        require_once(ROOT.'/views/admin/index.php');
        
        return true;
    }
}
