<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Service\RevotestController;
use App\Service\FluidlineController;


class ApiController extends AbstractController
{
    private $revo;

    public function __construct()
    {
        $this->revo = new RevotestController();
        $this->fluid = new FluidlineController();
    }

    /**
     * Добавление связанных полей в базу данных. "revo-test.site"
     */
    #[Route('/api/revo/add', name: 'app_api_add')]
    public function add(Request $request): JsonResponse
    {
        $response = $this->revo->add_revo_entity($request->request->get('push_id'));

        return new JsonResponse(["path" => "/api/add", "POST DATA" => $request->request->all(), "Method" => "add", "Response" => $response]);
    }

    /**
     * Удаление записей и связанных полей из базы данных. "revo-test.site"
     */
    #[Route('/api/revo/delete', name: 'app_api_delete')]
    public function delete(Request $request): JsonResponse
    {
        $response = $this->revo->delete_revo_entity($request->request->get('delete_id'));

        return new JsonResponse(["path" => "/api/add", "POST DATA" => $request->request->all(), "Method" => "add", "Response" => $response]);
    }

    /**
     * Добавление файла конфигурации базы данных. "revo-test.site"
     */
    #[Route('/api/revo/change/settings', name: 'app_revo_change_settings')]
    public function revo_change_settings(Request $request): JsonResponse
    {
        $response = $request->request->all();

        $response = $this->revo->configure_settings($response);

        return new JsonResponse(["path" => "/api/revo/change/settings", "POST DATA" => $request->request->all(), "Method" => "revo change settings", "Response" => $response]);
    }

    /**
     * Добавление файла конфигурации базы данных. "fluid-line.ru"
     */
    #[Route('/api/fluid/change/settings', name: 'app_fluid_change_settings')]
    public function fluid_change_settings(Request $request): JsonResponse
    {
        $response = $request->request->all();

        $response = $this->fluid->configure_settings($response);

        return new JsonResponse(["path" => "/api/fluid/change/settings", "POST DATA" => $request->request->all(), "Method" => "fluid change settings", "Response" => $response]);
    }
}
