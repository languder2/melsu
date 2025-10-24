<?php
if (!function_exists('clean_svg')) {
    function clean_svg($svg_content)
    {
        if (!is_string($svg_content) || empty($svg_content)) return '';

        $dom = new DOMDocument();

        libxml_use_internal_errors(true);
        $dom->loadXML($svg_content);
        libxml_clear_errors();

        $unsafe_tags = ['script', 'style', 'foreignObject'];
        $event_prefix = 'on';

        $elements = $dom->getElementsByTagName('*');

        foreach ($elements as $element) {
            if (in_array($element->tagName, $unsafe_tags, true)) {
                $element->parentNode->removeChild($element);
                continue;
            }

            if ($element->hasAttributes()) {
                $attributesToRemove = [];

                foreach ($element->attributes as $attr) {
                    if (str_starts_with($attr->name, $event_prefix)) {
                        $attributesToRemove[] = $attr->name;
                    }
                }

                foreach ($attributesToRemove as $attrName) {
                    $element->removeAttribute($attrName);
                }
            }
        }

        return $dom->saveXML($dom->documentElement);    }
}
