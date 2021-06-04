<?php
declare(strict_types=1);

namespace Falgun\RssFeeder\Tests;

use Falgun\RssFeeder\Entry;
use PHPUnit\Framework\TestCase;

final class EntryFormatTest extends TestCase
{

    public function testFormatIsOk()
    {
        $title = ':title:';
        $link = ':link:';
        $id = $link;
        $author = ':author-name:';
        $summary = ':summary text:';
        $updated = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2021-02-28 23:59:59');

        $entry = new Entry($id, $link, $title, $author, $summary, $updated);

        $this->assertSame(<<<EXPECTED

                <entry>
                    <title><![CDATA[ :title: ]]></title>
                    <link rel="alternate" href=":link:"/>
                    <id>:link:</id>
                    <author>
                        <name>:author-name:</name>
                    </author>
                    <summary type="html"><![CDATA[ :summary text: ]]></summary>
                    <updated>2021-02-28T23:59:59+00:00</updated>
                </entry>

            EXPECTED,
            $entry->format());
    }
}
