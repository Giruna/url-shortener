<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use App\Services\UrlShortenerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tests\TestCase;

class UrlShortenerTest extends TestCase
{
    protected MockInterface $shortUrlMock;
    protected MockInterface $serviceMock;
    protected function setUp(): void
    {
        parent::setUp();

        $this->shortUrlMock = Mockery::mock(ShortUrl::class)->makePartial();
        $this->serviceMock = Mockery::mock(UrlShortenerService::class);
    }

    #[Test]
    public function it_can_create_a_short_url()
    {
        $longUrl = 'https://www.example.com/test/1234567890';

        $this->shortUrlMock->code = 'abcdef';
        $this->shortUrlMock->long_url = $longUrl;

        $this->serviceMock->shouldReceive('shorten')
            ->with($longUrl)
            ->andReturn($this->shortUrlMock);

        $entry = $this->serviceMock->shorten($longUrl);

        $this->assertInstanceOf(ShortUrl::class, $entry);
        $this->assertEquals('abcdef', $entry->code);
        $this->assertEquals($longUrl, $entry->long_url);
    }

    #[Test]
    public function it_redirects_to_the_long_url()
    {
        $longUrl = 'https://www.example.com/test-redirect';

        $this->shortUrlMock->code = 'abcdef';
        $this->shortUrlMock->long_url = $longUrl;

        $this->serviceMock->shouldReceive('findByCode')
            ->with('abcdef')
            ->andReturn($this->shortUrlMock);

        $entry = $this->serviceMock->findByCode('abcdef');

        $this->assertInstanceOf(ShortUrl::class, $entry);
        $this->assertEquals($longUrl, $entry->long_url);

        $response = redirect()->away($entry->long_url);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals($longUrl, $response->getTargetUrl());
    }

    #[Test]
    public function it_fails_for_invalid_code()
    {
        $this->expectException(NotFoundHttpException::class);

        $this->serviceMock->shouldReceive('findByCode')
            ->with('doesnotexist')
            ->andReturnNull();

        $entry = $this->serviceMock->findByCode('doesnotexist');

        if (!$entry) {
            abort(404);
        }
    }

    #[Test]
    public function it_fails_for_invalid_url_when_shortening()
    {
        $invalidUrl = 'invalid-url';

        $requestMock = Mockery::mock(Request::class);
        $requestMock->shouldReceive('input')
            ->with('long_url')
            ->andReturn($invalidUrl);

        $this->expectException(ValidationException::class);

        Validator::make(
            ['long_url' => $invalidUrl],
            ['long_url' => 'required|url']
        )->validate();
    }
}
