<?php

namespace Tests\Unit;

use App\Repositories\Contracts\AttendeeRepositoryInterface;
use App\Services\TicketCodeGenerator;
use Mockery;
use Tests\TestCase;

class TicketCodeGeneratorTest extends TestCase
{
    public function test_it_generates_next_year_sequence(): void
    {
        $repository = Mockery::mock(AttendeeRepositoryInterface::class);
        $repository->shouldReceive('latestSequenceForYear')
            ->once()
            ->with((int) now()->format('Y'))
            ->andReturn(41);

        $code = (new TicketCodeGenerator($repository))->next();

        $this->assertSame(sprintf('EVT-%s-000042', now()->format('Y')), $code);
    }
}
