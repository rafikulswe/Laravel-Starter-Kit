<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Resource;
use App\Models\Scope;
use App\Models\ScopeAction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class PermissionsSeeder extends Seeder
{
    const ROLE_ADMIN_PK = 1;

    const USER_ADMIN_PK = 1;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Seeder File Path (Example): common/auth/employeePermission.json');
        $seederFilepath = $this->command->ask('Seeder File Path');
        if (!empty($seederFilepath)) {
            $jsonFile = 'database/seeders/json/permission/' . $seederFilepath;
            $fileData = file_get_contents($jsonFile);
            $jsonData = json_decode($fileData, true);
            $jsonError = json_last_error();
            if ($jsonError !== JSON_ERROR_NONE) {
                $this->command->info('Unable to parse json file: ' . $jsonFile);
            }

            // Create Resource
            $resource = $this->createResource($jsonFile, $jsonData);
            if (!empty($resource)) {
                // Create Scope
                $resourceId = $resource->id;
                $this->createScope($jsonFile, $jsonData, $resourceId);
            }
        } else {
            $jsonFiles = $this->getAllJsonFiles();
            foreach ($jsonFiles as $jsonFile) {
                $jsonData = json_decode(file_get_contents($jsonFile), true);

                // Create Resource
                $resource = $this->createResource($jsonFile, $jsonData);
                if (empty($resource)) {
                    continue;
                }

                // Create Scope
                $resourceId = $resource->id;
                $this->createScope($jsonFile, $jsonData, $resourceId);
            }
        }

        $this->command->info('Resource, Scope and Permission table seeded!');
    }

    protected function getAllJsonFiles()
    {
        $jsonFiles = [];

        $path = base_path("database/seeders/json/permission");
        $files = File::allFiles($path);
        foreach ($files as $key => $file) {
            $fileRealPath = $file->getRealPath();
            $fileExtension = $file->getExtension();
            if ($fileExtension == 'json') {
                $jsonFiles[] = $fileRealPath;
            }
        }

        return $jsonFiles;
    }

    protected function createResource($jsonFile, $jsonData)
    {
        $data = Arr::get($jsonData, 'resource', null);
        if (empty($data)) {
            $this->command->info('Resource not found! file:' . $jsonFile);
            return null;
        }

        try {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $resource = Resource::where('name', $data['name'])->first();
            if (!empty($resource)) {
                $updateData = [
                    "permission_type" => Arr::get($data, 'permission_type', $resource->permission_type),
                    "name" => Arr::get($data, 'name', $resource->name),
                    "display_name" => Arr::get($data, 'display_name', $resource->display_name),
                    "resource_uri" => Arr::get($data, 'resource_uri', $resource->resource_uri),
                    "controller_name" => Arr::get($data, 'controller_name', $resource->controller_name),
                    "server_url_prefix" => Arr::get($data, 'server_url_prefix', $resource->server_url_prefix),
                    // "component" => Arr::get($data, 'component', $resource->component),
                ];
                $resource->update($updateData);
            } else {
                $insertData = [
                    "permission_type" => Arr::get($data, 'permission_type', null),
                    "name" => Arr::get($data, 'name', null),
                    "display_name" => Arr::get($data, 'display_name', null),
                    "resource_uri" => Arr::get($data, 'resource_uri', null),
                    "controller_name" => Arr::get($data, 'controller_name', null),
                    "server_url_prefix" => Arr::get($data, 'server_url_prefix', null),
                    // "component" => Arr::get($data, 'component', null),

                    "sort_order" => Arr::get($data, 'sort_order', 0),
                    "created_by" => 1,
                    "updated_by" => 1,
                    "created_at" => Arr::get($data, 'created_at', $now),
                    "updated_at" => Arr::get($data, 'updated_at', $now),
                    "status" => Arr::get($data, 'status', 1)
                ];
                $resource = Resource::create($insertData);
            }

            return $resource;
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
            return null;
        }
    }

    protected function createScope($jsonFile, $jsonData, $resourceId)
    {
        $items = Arr::get($jsonData, 'scopes', null);
        if (empty($items) || empty($resourceId)) {
            $this->command->info('Scope not found! file:' . $jsonFile);
            return null;
        }

        $now = Carbon::now()->format('Y-m-d H:i:s');
        foreach ($items as $item) {
            try {
                $scope = Scope::where('scope', $item['scope'])->first();
                if (!empty($scope)) {
                    $updateData = [
                        "resource_id" => $resourceId,
                        "scope" => Arr::get($item, 'scope', null),
                        "display_name" => Arr::get($item, 'display_name', $scope->display_name),
                    ];
                    $scope->update($updateData);
                } else {
                    $insertData = [
                        "resource_id" => $resourceId,
                        "scope" => Arr::get($item, 'scope', null),
                        "display_name" => Arr::get($item, 'display_name', null),

                        "sort_order" => Arr::get($item, 'sort_order', 0),
                        "created_by" => Arr::get($item, 'created_by', self::USER_ADMIN_PK),
                        "updated_by" => Arr::get($item, 'updated_by', self::USER_ADMIN_PK),
                        "created_at" => Arr::get($item, 'created_at', $now),
                        "updated_at" => Arr::get($item, 'updated_at', $now),
                        "status" => Arr::get($item, 'status', 1),
                    ];
                    $scope = Scope::create($insertData);
                }

                if (empty($scope)) {
                    continue;
                }

                // Save Scope Action
                $actions = $item['actions'];
                if (!empty($actions)) {
                    foreach ($actions as $action) {
                        $this->saveScopeAction($jsonFile, $action, $resourceId, $scope);
                    }
                }

                // Create Admin Permission
                $this->createAdminPermission($scope);
            } catch (\Exception $e) {
                $this->command->info($e->getMessage());
                continue;
            }
        }
    }

    protected function saveScopeAction($jsonFile, $item, $resourceId, $scope)
    {

        if (empty($item) || empty($scope)) {
            $this->command->info('Scope not found! file:' . $jsonFile);
            return null;
        }

        $scopeId = $scope->id;
        $scopeName = $scope->display_name;

        try {
            $action = ScopeAction::where('scope_id', $scopeId)
                ->where('http_method', $item['http_method'])
                ->where('uri', $item['uri'])
                ->first();

            if (!empty($action)) {
                $updateData = [
                    "resource_id" => $resourceId,
                    "scope_id" => $scopeId,
                    "http_method" => Arr::get($item, 'http_method', null),
                    "action_name" => Arr::get($item, 'action_name', null),
                    "uri" => Arr::get($item, 'uri', null),
                ];
                $action->update($updateData);
            } else {
                $insertData = [
                    "resource_id" => $resourceId,
                    "scope_id" => $scopeId,
                    "http_method" => Arr::get($item, 'http_method', null),
                    "action_name" => Arr::get($item, 'action_name', null),
                    "uri" => Arr::get($item, 'uri', null)
                ];
                ScopeAction::create($insertData);
            }
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
        }
    }

    protected function createAdminPermission($scope)
    {
        if (empty($scope)) {
            return null;
        }

        try {
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $permission = Permission::where('scope_id', $scope->id)->where('role_id', self::ROLE_ADMIN_PK)->first();
            if (!empty($permission)) {
                $updateData = [
                    "scope_id" => Arr::get($scope, 'id'),
                    "role_id" => self::ROLE_ADMIN_PK,
                ];
                $permission->update($updateData);
            } else {
                $insertData = [
                    "scope_id" => Arr::get($scope, 'id'),
                    "role_id" => self::ROLE_ADMIN_PK,

                    "created_by" => self::USER_ADMIN_PK,
                    "updated_by" => self::USER_ADMIN_PK,
                    "created_at" => $now,
                    "updated_at" => $now,
                    "status" => 1,
                ];
                $permission = Permission::create($insertData);
            }
        } catch (\Exception $e) {
            $this->command->info($e->getMessage());
            return null;
        }
    }
}
