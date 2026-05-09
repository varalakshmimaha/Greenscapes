<?php

namespace App\Helpers;

class BlogContentFormatter
{
    public static function format(?string $content): string
    {
        $content = trim((string) $content);

        if ($content === '') {
            return '';
        }

        if (self::containsHtml($content)) {
            return $content;
        }

        $lines = preg_split("/\r\n|\r|\n/", $content);
        $html = [];
        $paragraph = [];
        $listItems = [];
        $listType = null;

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                self::flushParagraph($html, $paragraph);
                self::flushList($html, $listItems, $listType);
                continue;
            }

            if (preg_match('/^(?:[-*]|\x{2022})\s+(.*)$/u', $trimmed, $matches)) {
                self::flushParagraph($html, $paragraph);
                if ($listType !== null && $listType !== 'ul') {
                    self::flushList($html, $listItems, $listType);
                }
                self::pushListItem($listItems, $listType, 'ul', $matches[1]);
                continue;
            }

            if (preg_match('/^\d+[\.\)]\s+(.*)$/u', $trimmed, $matches)) {
                self::flushParagraph($html, $paragraph);
                if ($listType !== null && $listType !== 'ol') {
                    self::flushList($html, $listItems, $listType);
                }
                self::pushListItem($listItems, $listType, 'ol', $matches[1]);
                continue;
            }

            self::flushList($html, $listItems, $listType);
            $paragraph[] = e($trimmed);
        }

        self::flushParagraph($html, $paragraph);
        self::flushList($html, $listItems, $listType);

        return implode("\n", $html);
    }

    public static function toPlainText(?string $content): string
    {
        $content = trim((string) $content);

        if ($content === '') {
            return '';
        }

        if (! self::containsHtml($content)) {
            return trim((string) preg_replace('/\s+/u', ' ', $content));
        }

        $plainText = str_replace(
            ['<br>', '<br/>', '<br />', '</p>', '</li>', '</ul>', '</ol>'],
            ["\n", "\n", "\n", "\n\n", "\n", "\n", "\n"],
            $content
        );

        return trim((string) preg_replace('/\s+/u', ' ', strip_tags($plainText)));
    }

    private static function containsHtml(string $content): bool
    {
        return preg_match('/<\s*\/?\s*[a-z][^>]*>/i', $content) === 1;
    }

    private static function flushParagraph(array &$html, array &$paragraph): void
    {
        if ($paragraph === []) {
            return;
        }

        $html[] = '<p>' . implode('<br>', $paragraph) . '</p>';
        $paragraph = [];
    }

    private static function flushList(array &$html, array &$listItems, ?string &$listType): void
    {
        if ($listItems === [] || $listType === null) {
            $listItems = [];
            $listType = null;
            return;
        }

        $html[] = '<' . $listType . '><li>' . implode('</li><li>', $listItems) . '</li></' . $listType . '>';
        $listItems = [];
        $listType = null;
    }

    private static function pushListItem(array &$listItems, ?string &$listType, string $type, string $value): void
    {
        $listType = $type;
        $listItems[] = e(trim($value));
    }
}
