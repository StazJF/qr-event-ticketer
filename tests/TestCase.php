<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    protected function clearMongoCollections(): void
    {
        foreach (['events', 'attendees', 'users'] as $collection) {
            DB::connection('mongodb')->getCollection($collection)->deleteMany([]);
        }
    }
}
