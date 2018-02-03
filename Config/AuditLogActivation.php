<?php
/**
 * AuditLog Plugin activation
 *
 *
 */
class AuditLogActivation {

        /**
         * Schema directory
         *
         * @var string
         */
        private $SchemaDir;

        /**
         * DB connection
         *
         * @var object
         */
        private $db;

        /**
         * Plugin name
         *
         * @var string
         */
        public $pluginName = 'AuditLog';

        /**
         * Constructor
         *
         * @return vodi
         */
         public function  __construct() {

                 $this->SchemaDir = APP.'Plugin'.DS.$this->pluginName.DS.'Config'.DS.'Schema';
                 $this->db = ConnectionManager::getDataSource('default');
        }

        /**
         * Before onActivation
         *
         * @param object $controller
         * @return boolean
         */
        public function beforeActivation(&$controller) {

                App::uses('CakeSchema', 'Model');
                $CakeSchema = new CakeSchema();
                
                $all_tables = $this->db->listSources();

                // list schema files from config/schema dir
                if (!$cake_schema_files = $this->_listSchemas($this->SchemaDir))
                        return false;

                // create table for each schema
                foreach ($cake_schema_files as $schema_file) {
                        $schema_name = substr($schema_file, 0, -4);
                        $schema_class_name = Inflector::camelize($schema_name).'Schema';
                        $table_name = $schema_name;

                         include_once($this->SchemaDir.DS.$schema_file);
                        
                         $ActiveSchema = new $schema_class_name;
                         
                         foreach ($ActiveSchema->tables as $t=>$v){
                             if (in_array($t, $all_tables)){
                                 return true;
                             }
                         } 
                         
                         $sch = $this->db->createSchema($ActiveSchema);
                         if(!$this->db->execute($sch)) {
                                        return false;
                        }
                         
                }


                return true;

        }

        /**
         * Activation of plugin,
         * called only if beforeActivation return true
         *
         * @param object $controller
         * @return void
         */
        public function onActivation(&$controller) {
                $controller->Setting->write('AuditLog.models', 'Node', array(
                    'editable' => 1, 'description' => __('Put Model names that you want to store log changes, separate them with a coma ","', true))
                );
                  
                $controller->Croogo->addAco('AuditLog');
                $controller->Croogo->addAco('AuditLog/index', array('registered')); 
        }

        /**
         * Before onDeactivation
         *
         * @param object $controller
         * @return boolean
         */
        public function beforeDeactivation(&$controller) {

                // list schema files from config/schema dir
                if (!$cake_schema_files = $this->_listSchemas($this->SchemaDir))
                        return false;

                // delete tables for each schema
                foreach ($cake_schema_files as $schema_file) {
                        $schema_name = substr($schema_file, 0, -4);
                        $table_name = $schema_name;
                        /*if(!$this->db->execute('DROP TABLE '.$table_name)) {
                                return false;
                        }*/
                }
                return true;

        }

        /**
         * Deactivation of plugin,
         * called only if beforeActivation return true
         *
         * @param object $controller
         * @return void
         */
        public function onDeactivation(&$controller) {
            return true;
        }

        /**
         * List schemas
         *
         * @return array
         */
        private function _listSchemas($dir = false) {

                if (!$dir) return false;

                $cake_schema_files = array();
                if ($h = opendir($dir)) {
                        while (false !== ($file = readdir($h))) {
                                if (($file != ".") && ($file != "..") && ($file != ".svn")) {
                                        $cake_schema_files[] = $file;
                                }
                        }
                } else {
                        return false;
                }

                return $cake_schema_files;

        }
}
?>