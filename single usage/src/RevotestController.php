<?php
    require_once __DIR__."/FluidlineController.php";
    require_once __DIR__."/SupportController.php";

    class RevotestController extends Support
    {
        private $filepath = __DIR__."/revo.settings";
        private $fluid;

        public function __construct()
        {
            $this->fluid = new FluidlineController();
        }

        /*
         *  Добавление сущности в Revo
         */
        public function add_revo_entity(int $entity_id = 7737149)
        {
            $revo_link = $this->db_connection($this->filepath); 
            $revo_link->set_charset(Support::CHARSET);

            $response = "Добавление: revo_modx_site_content: ".json_encode($this->put_main_entity($this->fluid->get_fluid_entity($entity_id), $revo_link));
            $response .= ";<br> Добавление: revo_modx_site_tmplvar_contentvalues: ".json_encode($this->put_content_entities($this->fluid->get_fluid_entity_content($entity_id), $revo_link)).";";

            mysqli_close($revo_link);

            return $response;
        }

        /*
         *  Запрос от пользователя на удаление записей.
         */
        public function delete_revo_entity(int $entity_id)
        {
            $revo_link = $this->db_connection($this->filepath);

            $response = "Удаление: revo_modx_site_content: ".json_encode($this->delete_entity_from_table($revo_link, "revo_modx_site_content", "id", $entity_id));
            $response .= ";<br> Удаление: revo_modx_site_tmplvar_contentvalues: ".json_encode($this->delete_entity_from_table($revo_link, "revo_modx_site_tmplvar_contentvalues", "contentid", $entity_id)).";";

            mysqli_close($revo_link);
            
            return $response;
        }

        /*
         *  Создание сущности modx_site_content
         */
        private function put_main_entity(array $entities, $link)
        {
            $set = [];

            foreach ($entities as $key => $value)
            {
                if (is_string($key))
                {
                    array_push($set, '\''.mysqli_real_escape_string($link, $value).'\'');
                }
            }

            $response = $this->insert_entity_to_table($link, "revo_modx_site_content", "(".implode(",", $set).")");

            return $response;
        }

        /*
         *  Создание сущности modx_site_tmplvar_contentvalues
         */
        private function put_content_entities(array $entities, $link)
        {
            $set = [];

            foreach ($entities as $key => $value)
            {
                array_push($set, "('".implode("','",  $value)."')");
            }

            $response = $this->insert_entity_to_table($link, "revo_modx_site_tmplvar_contentvalues", implode(",", $set));

            return $response;
        }

        private function insert_entity_to_table($link, string $table, string $values)
        {
            $query = "INSERT INTO `$table` VALUES $values";
            
            $response = $link->query($query);

            if ($response)
            {
                $this->append_log_file("insert entity to revo: table: $table; response: $response.");

                return $response;
            }
        }


        /*
         *  Удаление значений из таблицы.
         */
        private function delete_entity_from_table($link, string $table, string $column, int $entity_id)
        {
            $query = "DELETE FROM `$table` WHERE `$column` = $entity_id";

            $response = $link->query($query);
            
            $this->append_log_file("try to delete entity from revo: table: $table; response: $response; id: $entity_id.");

            return $response;
        }

        /*
         *  Конфигурация настроек.
         */
        public function configure_settings(array $request)
        {
            return $this->set_settings($this->filepath, $request);
        }
    }