<?php
declare(strict_types=1);

namespace Falgun\RssFeeder\Tests;

use Falgun\RssFeeder\Feed;
use Falgun\RssFeeder\Entry;
use PHPUnit\Framework\TestCase;

final class FeedFormatTest extends TestCase
{

    public function testFormatIsOk()
    {
        $id = ':feed-id:';
        $link = $id;
        $title = ':feed-title:';
        $updated = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2021-03-31 23:59:59');

        $feed = new Feed($id, $link, $title, $updated);
        $feed->setEntry($this->getEntry(1));
        $feed->setEntry($this->getEntry(2));
        $feed->setEntry($this->getEntry(3));

        $this->assertSame(<<<EXPECTED
            <feed xmlns="http://www.w3.org/2005/Atom">
                <title><![CDATA[ :feed-title: ]]></title>
                <id>:feed-id:</id>
                <link rel="self" href=":feed-id:"/>
                <updated>2021-03-31T23:59:59+00:00</updated>
                
                <entry>
                    <title><![CDATA[ :title-1: ]]></title>
                    <link rel="alternate" href=":link-1:"/>
                    <id>:link-1:</id>
                    <author>
                        <name>:author-name:</name>
                    </author>
                    <summary type="html"><![CDATA[ :summary text: ]]></summary>
                    <updated>2021-02-28T23:59:59+00:00</updated>
                </entry>

                <entry>
                    <title><![CDATA[ :title-2: ]]></title>
                    <link rel="alternate" href=":link-2:"/>
                    <id>:link-2:</id>
                    <author>
                        <name>:author-name:</name>
                    </author>
                    <summary type="html"><![CDATA[ :summary text: ]]></summary>
                    <updated>2021-02-28T23:59:59+00:00</updated>
                </entry>

                <entry>
                    <title><![CDATA[ :title-3: ]]></title>
                    <link rel="alternate" href=":link-3:"/>
                    <id>:link-3:</id>
                    <author>
                        <name>:author-name:</name>
                    </author>
                    <summary type="html"><![CDATA[ :summary text: ]]></summary>
                    <updated>2021-02-28T23:59:59+00:00</updated>
                </entry>

            </feed>
            EXPECTED,
            $feed->format());
    }

    private function getEntry(int $i): Entry
    {

        $title = ":title-$i:";
        $link = ":link-$i:";
        $id = $link;
        $author = ':author-name:';
        $summary = ':summary text:';
        $updated = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', '2021-02-28 23:59:59');

        return new Entry($id, $link, $title, $author, $summary, $updated);
    }
}
