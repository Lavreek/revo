<?php
    require_once __DIR__."/RevotestController.php";
    require_once __DIR__."/FluidlineController.php";

    class ApiController 
    {
        public function __construct()
        {
            $this->revo = new RevotestController();
            $this->fluid = new FluidlineController();
        }

        /**
         * Добавление связанных полей в базу данных. "revo-test.site"
         */
        public function add(array $POST_ARRAY)
        {
            $response = $this->revo->add_revo_entity($POST_ARRAY['push_id']);

            return json_encode(["POST DATA" => $POST_ARRAY, "Method" => "add", "Response" => $response]);
        }

        /**
         * Удаление записей и связанных полей из базы данных. "revo-test.site"
         */
        public function delete(array $POST_ARRAY)
        {
            $response = $this->revo->delete_revo_entity($POST_ARRAY['delete_id']);

            return json_encode(["POST DATA" => $POST_ARRAY, "Method" => "add", "Response" => $response]);
        }

        /**
         * Добавление файла конфигурации базы данных. "revo-test.site"
         */
        public function revo_change_settings(array $POST_ARRAY)
        {

            $response = $this->revo->configure_settings($POST_ARRAY);

            return json_encode(["POST DATA" => $POST_ARRAY, "Method" => "revo change settings", "Response" => $response]);
        }

        /**
         * Добавление файла конфигурации базы данных. "fluid-line.ru"
         */
        public function fluid_change_settings(array $POST_ARRAY)
        {
            $response = $this->fluid->configure_settings($POST_ARRAY);

            return json_encode(["POST DATA" => $POST_ARRAY, "Method" => "fluid change settings", "Response" => $response]);
        }
    }
