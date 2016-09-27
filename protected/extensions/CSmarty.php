<?php
/**
 * Created by PhpStorm.
 * User: hongzhiyuan
 * Date: 2016/9/27
 * Time: 23:17
 */
require_once (Yii::getPathOfAlias('application.extensions.smarty') . DIRECTORY_SEPARATOR . 'Smarty.class.php');
define('SMARTY_TEMPLATE_DIR', Yii::getPathOfAlias('smarty.template'));
define('SMARTY_PLUGIN_DIR', Yii::getPathOfAlias('smarty.plugin'));
class CSmarty extends Smarty {
    const DIR_SEP = DIRECTORY_SEPARATOR;
    function __construct() {
        parent::__construct();
        $this->template_dir = SMARTY_TEMPLATE_DIR;
        $this->addPluginsDir(SMARTY_PLUGIN_DIR);
        $this->addConfigDir(Yii::getPathOfAlias('smarty.config'));
        $this->compile_dir = SMARTY_TEMPLATE_DIR . self::DIR_SEP . 'template_c';
        //$this->caching = true;
        $this->cache_dir = SMARTY_TEMPLATE_DIR . self::DIR_SEP . 'cache';
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