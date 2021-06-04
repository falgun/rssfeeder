<?php
declare(strict_types=1);

namespace Falgun\RssFeeder;

use DateTimeImmutable;

final class Feed
{

    private string $id;
    private string $link;
    private string $title;
    private DateTimeImmutable $updated;

    /** @var array<int, Entry> */
    private array $entries;

    public function __construct(string $id, string $link, string $title, DateTimeImmutable $updated = null)
    {
        $this->id = $id;
        $this->link = $link;
        $this->title = $title;
        $this->updated = $updated ?? new DateTimeImmutable();
        $this->entries = [];
    }

    public function setEntry(Entry $entry): void
    {
        $this->entries[] = $entry;
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text);
    }

    public function format(): string
    {
        $entryContent = '';

        foreach ($this->entries as $entry) {
            $entryContent .= $entry->format();
        }

        return <<<Feed
        <feed xmlns="http://www.w3.org/2005/Atom">
            <title><![CDATA[ {$this->escape($this->title)} ]]></title>
            <id>{$this->id}</id>
            <link rel="self" href="{$this->link}"/>
            <updated>{$this->updated->format(\DateTime::W3C)}</updated>
            {$entryContent}
        </feed>
        Feed;
    }
}
