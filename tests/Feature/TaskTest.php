<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\TaskComment;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->auth(1);
    }

    /**
     * Test for create task
     */
    public function test_create_task(): void
    {
        $this->postJson('/api/task', [
            "task_name" => "Task 1 ",
            "task_description" => "Todo List 1",
            "assigned_team" => 1,
            "assigned_building" => 1,
            "assigned_user" => 1
        ])->assertCreated();
    }

    /**
     * Test for create task with no optional params
     */
    public function test_create_task_no_optinal_params(): void
    {
        $this->postJson('/api/task', [
            "task_name" => "Task No Optinal",
            "assigned_team" => 1,
            "assigned_building" => 1,
        ])->assertCreated();
    }

    /**
     * Test for create task with missing params
     */
    public function test_missing_params_on_create_task(): void
    {
        $response = $this->postJson('/api/task')->assertUnprocessable();
        $this->assertEquals('Validation errors', $response['message']);
        $this->assertCount(3, $response['data']);
    }

    /**
     * Test for update task with missing params
     */
    public function test_missing_params_update_task(): void
    {
        $response = $this->putJson('/api/task')->assertUnprocessable()->json();

        $this->assertEquals('Validation errors', $response['message']);
        $this->assertCount(1, $response['data']);
    }

    /**
     * Test for update task
     */
    public function test_update_task(): void
    {
        $task = Task::factory(1, [
            'assigned_team' => 1
        ])
            ->create()
            ->toArray();

        $taskId = current($task)['id'];
        $updateTaskName = 'Update Test';
        $updateTaskDescription = 'Update TestDescription';
        $updateAssignUser = 2;
        $updateTaskStatus = TaskStatus::IN_PROGRESS;

        $response = $this->putJson('/api/task', [
            'task_id' => $taskId,
            'task_name' => $updateTaskName,
            'task_description' => $updateTaskDescription,
            'assigned_user' => $updateAssignUser,
            'task_status' => $updateTaskStatus,
        ])->assertOk()->json();

        $updatedTask = Task::find($taskId);

        $this->assertEquals($updateTaskName, $updatedTask->task_name);
        $this->assertEquals($updateTaskDescription, $updatedTask->task_description);
        $this->assertEquals($updateAssignUser, $updatedTask->assigned_user);
        $this->assertEquals($updateTaskStatus, $updatedTask->task_status);
    }

    /**
     * Test for fetch tasks
     */
    public function test_fetch_task(): void
    {
        Task::factory(2)->create();
        $response = $this->getJson('/api/task')->assertOk();
        $this->assertCount(2, $response->json());
    }

    /**
     * Test for task with task_data filter
     */
    public function test_fetch_task_with_date_filter(): void
    {
        Task::factory(1)->create();
        Task::factory(1)->create(
            [
                'created_at' => date('Y-m-d', strtotime(' + 1 days'))
            ]
        );

        $today = date('Y-m-d');
        $response = $this->getJson(
            "/api/task?task_creation_start={$today}"
        )->assertOk()
            ->json();

        $this->assertCount(1, $response);
        $this->assertEquals(
            $today,
            date(
                'Y-m-d',
                strtotime(current($response)['created_at'])
            )
        );
    }

    /**
     * Test for task with task_data range filter
     */
    public function test_fetch_task_with_date_range_filter(): void
    {
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-d', strtotime(' + 1 days'));

        Task::factory(1)->create();
        Task::factory(1)->create(
            [
                'created_at' => $tomorrow
            ]
        );

        $today = date('Y-m-d');
        $response = $this->getJson(
            "/api/task?task_creation_start={$today}&task_creation_end={$tomorrow}"
        )->assertOk()
            ->json();

        $this->assertCount(2, $response);

        $this->assertEquals(
            $today,
            date(
                'Y-m-d',
                strtotime(($response)[0]['created_at'])
            )
        );

        $this->assertEquals(
            $tomorrow,
            date(
                'Y-m-d',
                strtotime(($response)[1]['created_at'])
            )
        );
    }

    /**
     * Test for task with assigned_user filter
     */
    public function test_fetch_task_with_assigned_user(): void
    {

        Task::factory(1)->create(
            [
                'assigned_user' => 1
            ]
        );
        Task::factory(1)->create(
            [
                'assigned_user' => 2
            ]
        );

        $response = $this->getJson(
            "/api/task?assigned_user=1"
        )->assertOk()
            ->json();

        $this->assertCount(1, $response);
        $this->assertEquals(1, current($response)['assigned_user']);
    }

    /**
     * Test for task with task_status filter
     */
    public function test_fetch_task_with_task_status(): void
    {
        Task::factory(1)->create(
            [
                'task_status' => 1
            ]
        );
        Task::factory(1)->create(
            [
                'task_status' => 2
            ]
        );

        $response = $this->getJson(
            "/api/task?task_status=1"
        )->assertOk()
            ->json();

        $this->assertCount(1, $response);
        $this->assertEquals(1, current($response)['task_status']);
    }



    /**
     * Test for task with comment 
     */
    public function test_fetch_task_with_comment(): void
    {
        Task::factory(1)->create();
        TaskComment::factory(1, [
            "task_id" => 1
        ])->create();

        $response = $this->getJson('/api/task')->assertOk()->json();

        $this->assertCount(1, $response);
        $this->assertCount(1, current($response)['task_comment']);
    }
}
