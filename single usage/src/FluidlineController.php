<?php
    require_once __DIR__."/SupportController.php";

    class FluidlineController extends Support
    {
        public $filepath = __DIR__."/fluidline.settings";

        /*
         *  Копирование сущности из Fluid
         */
        public function get_fluid_entity(int $entity_id)
        {
            $response = $this->select_table_content("modx_site_content", "id", $entity_id);

            return $response;
        }

        public function get_fluid_entity_content(int $entity_id)
        {
            $response = $this->select_table_content("modx_site_tmplvar_contentvalues", "contentid", $entity_id, true);

            return $response;
        }

        private function select_table_content(string $table, string $column, int $entity_id, bool $multi = false)
        {
            $fluid_link = $this->db_connection($this->filepath);
            $fluid_link->set_charset(Support::CHARSET);

            $query = "SELECT * FROM `$table` WHERE `$column` = $entity_id";
            
            $response = $fluid_link->query($query);

            mysqli_close($fluid_link);

            // Multi choose (without params)
            if (!$multi) 
                return mysqli_fetch_array($response);
            else
                return mysqli_fetch_all($response);
        }

        /*
         *  Конфигурация настроек.
         */
        public function configure_settings(array $request)
        {
            return $this->set_settings($this->filepath, $request);
        }  
    }