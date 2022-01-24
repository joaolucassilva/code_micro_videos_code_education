<?php

namespace Tests\Traits;

use Exception;

trait TestSaves
{
    /**
     * @throws Exception
     */
    protected function assertStore($sendData, $testData)
    {
        $response = $this->json('POST', $this->routeStore(), $sendData);

        if ($response->status() !== 201) {
            throw new Exception("Response status must be 201, given {$response->status()}:\n {$response->content()}");
        }

        $this->assertDatabaseHas($this->model->getTable(), $testData + ['id' => $response->json('id')]);
    }
}
