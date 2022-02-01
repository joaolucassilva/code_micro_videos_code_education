<?php

namespace Tests\Traits;

use Exception;
use Illuminate\Foundation\Testing\TestResponse;

trait TestSaves
{
    /**
     * @throws Exception
     */
    protected function assertStore(array $sendData, array $testDatabase, array $testJsonData = null): TestResponse
    {
        $response = $this->json('POST', $this->routeStore(), $sendData);

        if ($response->status() !== 201) {
            throw new Exception("Response status must be 201, given {$response->status()}:\n {$response->content()}");
        }

        $this->assertInDatabase($response, $testDatabase);
        $this->assertJsonResponseContent($response, $testDatabase, $testJsonData);

        return $response;
    }

    protected function assertUpdate(array $sendData, array $testDatabase, array $testJsonData = null)
    {
        $response = $this->json('PUT', $this->routeUpdate(), $sendData);

        if ($response->status() !== 200) {
            throw new Exception("Response status must be 200, given {$response->status()}:\n {$response->content()}");
        }

        $this->assertInDatabase($response, $testDatabase);
        $this->assertJsonResponseContent($response, $testDatabase, $testJsonData);

        return $response;
    }

    private function assertInDatabase(TestResponse $response, array $testDatabase)
    {
        $this->assertDatabaseHas($this->model->getTable(), $testDatabase + ['id' => $response->json('id')]);
    }

    private function assertJsonResponseContent(TestResponse $response, array $testDatabase, array $testJsonData = null)
    {
        $testResponse = $testJsonData ?? $testDatabase;
        $response->assertJsonFragment($testResponse + ['id' => $response->json('id')]);
    }
}
