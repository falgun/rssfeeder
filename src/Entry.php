<?php
declare(strict_types=1);

namespace Falgun\RssFeeder;

use DateTimeImmutable;

final class Entry
{

    private string $id;
    private string $link;
    private string $title;
    private string $author;
    private string $summary;
    private DateTimeImmutable $updated;

    public function __construct(string $id, string $link, string $title, string $author, string $summary,
        DateTimeImmutable $updated)
    {
        $this->id = $id;
        $this->link = $link;
        $this->title = $title;
        $this->author = $author;
        $this->summary = $summary;
        $this->updated = $updated;
    }

    private function escape(string $text): string
    {
        return htmlspecialchars($text);
    }

    public function format(): string
    {
        return <<<ENTRY

            <entry>
                <title><![CDATA[ {$this->escape($this->title)} ]]></title>
                <link rel="alternate" href="{$this->link}"/>
                <id>{$this->id}</id>
                <author>
                    <name>{$this->author}</name>
                </author>
                <summary type="html"><![CDATA[ {$this->escape($this->summary)} ]]></summary>
                <updated>{$this->updated->format(\DateTime::W3C)}</updated>
            </entry>

        ENTRY;
    }
}
