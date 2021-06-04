<?php
declare(strict_types=1);

namespace Falgun\RssFeeder;

final class Generator
{

    private Feed $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function generate(string $path): bool
    {
        file_put_contents($path, $this->feed->format(), LOCK_EX);

        return file_exists($path);
    }
}
