# SiteMapper

Simple Rss Feed generator Library.

## Install
 *Please note that PHP 8.0 or higher is required.*

Via Composer

``` bash
$ composer require falgunphp/rssfeeder
```

## Usage
```php
<?php
use Falgun\RssFeeder\Feed;
use Falgun\RssFeeder\Entry;
use Falgun\RssFeeder\Generator;

$feed = new Feed(':feed-id:', ':feed-link:', ':feed-title:', new \DateTimeImmutable);

$feed->setEntry(new Entry(':entry-1-id:', ':entry-1-link:', ':entry-1-title:', ':entry-1-author:', ':entry-1-summary:', new \DateTimeImmutable));
$feed->setEntry(new Entry(':entry-2-id:', ':entry-2-link:', ':entry-2-title:', ':entry-2-author:', ':entry-2-summary:', new \DateTimeImmutable));
$feed->setEntry(new Entry(':entry-3-id:', ':entry-3-link:', ':entry-3-title:', ':entry-3-author:', ':entry-3-summary:', new \DateTimeImmutable));

(new Generator($feed))->generate('/path/to/rss.xml')
// rss.xml will be generated & saved in that file path
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
