<?php
/**
 * Created by PhpStorm.
 * User: hongzhiyuan
 * Date: 2016/9/27
 * Time: 23:17
 */
require_once (Yii::getPathOfAlias('application.extensions.smarty') . DIRECTORY_SEPARATOR . 'Smarty.class.php');
define('SMARTY_TEMPLATE_DIR', APPLICATION_PATH . 'template/smarty3');
define('SMARTY_PLUGIN_DIR', Yii::getPathOfAlias('application.extensions.smarty') . DIRECTORY_SEPARATOR . 'custom/');
class CSmarty extends Smarty {
    const DIR_SEP = DIRECTORY_SEPARATOR;
    function __construct() {
        parent::__construct();
        // Yii::registerAutoloader('smartyAutoload');
        $this->setTemplateDir(SMARTY_TEMPLATE_DIR);
        $this->setCompileDir(RUNTIME_PATH . 'template/compile/');
        $this->setConfigDir(RUNTIME_PATH . 'template/config/');
        $this->setCacheDir(RUNTIME_PATH . 'template/cache/');

        // $this->template_dir = SMARTY_TEMPLATE_DIR;
        $this->addPluginsDir(SMARTY_PLUGIN_DIR);
        // $this->addConfigDir(Yii::getPathOfAlias('smarty.config'));
        $this->left_delimiter = '{%';
        $this->right_delimiter = '%}';
        $this->cache_lifetime = 0;
    }

    function init() {
    }

    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null) {
        if (YII_DEBUG && ($_GET['__smarty__'] === 'var')) {
            echo json_encode($this->getTemplateVars());
        } else {
            return parent::display($template, $cache_id, $compile_id, $parent);
        }
    }
}