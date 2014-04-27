<?php



require(SMARTY_DIR . 'Smarty.class.php'); 
class Template extends Smarty {
    function __construct() {
      parent::__construct();
      $this->setTemplateDir(LIB_DIR . 'templates');
      $this->setCompileDir(LIB_DIR . 'templates_c');
      $this->setConfigDir(LIB_DIR . 'configs');
      $this->setCacheDir(LIB_DIR . 'cache');
      
      $this->setCaching(false);
      $this->setCompileCheck(true);
      
      
    }
}
      
?>
