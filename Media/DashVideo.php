<?php

declare(strict_types=1);

namespace RedditImage\Media;

class DashVideo implements DomElementInterface {
    private string $url;

    public function __construct(string $url) {
        $this->url = $url;
    }

    public function toDomElement(\DomDocument $domDocument): \DomElement {
        $div = $domDocument->createElement('div');
        $script = $div->appendChild($domDocument->createElement('script'));
        $script->setAttribute('type', 'text/javascript');
        $script->appendChild($finalDom->createTextNode(<<<EOT
if (!window.dashjs) {
    const script = document.createElement("script");
    script.setAttribute("src", "http://cdn.dashjs.org/v4.7.0/dash.all.min.js");
    document.getElementsByTagName("head")[0].appendChild(script);
}
EOT;));
        
        $video = $div->appendChild($domDocument->createElement('video'));
        $video->setAttribute('data-dashjs-player', 'true');
        $video->setAttribute('controls', 'true');
        $video->setAttribute('preload', 'metadata');
        $video->setAttribute('class', 'reddit-image');
        $video->setAttribute('src', $this->url);
        return $video;
    }
}
