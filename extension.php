<?php
declare(strict_types=1);

final class BashorgBrFixExtension extends Minz_Extension
{
    private const BASHORG_FEED_ID = 52;

    public function init(): void
    {
        $this->registerHook('entry_before_insert', [$this, 'fixEntry']);
    }

    public function fixEntry($entry)
    {
        if (
            !is_object($entry) ||
            !method_exists($entry, 'feedId') ||
            !method_exists($entry, 'content') ||
            !method_exists($entry, '_content')
        ) {
            return $entry;
        }

        if ((int)$entry->feedId() !== self::BASHORG_FEED_ID) {
            return $entry;
        }

        $content = $entry->content(false);
        if (!is_string($content) || $content === '') {
            return $entry;
        }

        // Remove one extra escaping layer:
        // &amp;lt;xxx&amp;gt; -> &lt;xxx&gt;
        $fixed = str_replace(
            ['&amp;lt;', '&amp;gt;'],
            ['&lt;', '&gt;'],
            $content
        );

        // Convert escaped BR markers into real HTML line breaks:
        // &lt;br&gt; -> <br>
        $fixed = preg_replace(
            '~&lt;\s*br\s*/?\s*&gt;~i',
            '<br>',
            $fixed
        );

        if (is_string($fixed) && $fixed !== $content) {
            $entry->_content($fixed);
        }

        return $entry;
    }
}
