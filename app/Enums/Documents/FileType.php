<?php

namespace App\Enums\Documents;

use BladeUI\Icons\Components\Icon;

enum FileType: string
{

    case AAC    = 'aac';
    case AI     = 'ai';
    case BMP    = 'bmp';
    case CS     = 'cs';
    case CSS    = 'css';
    case CSV    = 'csv';
    case DOC    = 'doc';
    case DOCX   = 'docx';
    case EXE    = 'exe';
    case GIF    = 'gif';
    case HEIC   = 'heic';
    case HTML   = 'html';
    case JAVA   = 'java';
    case JPG    = 'jpg';
    case JS     = 'js';
    case JSON   = 'json';
    case JSX    = 'jsx';
    case KEY    = 'key';
    case M4P    = 'm4p';
    case MD     = 'md';
    case MDX    = 'mdx';
    case MOV    = 'mov';
    case MP3    = 'mp3';
    case MP4    = 'mp4';
    case OTF    = 'otf';

    case PDF    = 'pdf';
    case PHP    = 'php';
    case PNG    = 'png';
    case PPT    = 'ppt';
    case PPTX   = 'pptx';
    case PSD    = 'psd';
    case PY     = 'py';
    case RAW    = 'raw';
    case RB     = 'rb';
    case SASS   = 'sass';
    case SCSS   = 'scss';
    case SH     = 'sh';
    case SQL    = 'sql';
    case SVG    = 'svg';
    case TIFF   = 'tiff';
    case TSX    = 'tsx';
    case TTF    = 'ttf';
    case TXT    = 'txt';
    case WAV    = 'wav';
    case WOFF   = 'woff';
    case XLS    = 'xls';
    case XLSX   = 'xlsx';
    case XML    = 'xml';
    case YML    = 'yml';
    case RAR    = 'rar';
    case ZIP    = 'zip';

    public function icon($size = 'text-4xl'): string
    {
        return match ($this) {
            self::RAR,
            self::ZIP       => "<i class='bi bi-file-earmark-zip $size'></i>",
            self::AAC       => "<i class='bi bi-filetype-aac $size'></i>",
            self::AI        => "<i class='bi bi-filetype-ai $size'></i>",
            self::BMP       => "<i class='bi bi-filetype-bmp $size'></i>",
            self::CS        => "<i class='bi bi-filetype-cs $size'></i>",
            self::CSS       => "<i class='bi bi-filetype-css $size'></i>",
            self::CSV       => "<i class='bi bi-filetype-csv $size'></i>",
            self::DOC       => "<i class='bi bi-filetype-doc $size'></i>",
            self::DOCX      => "<i class='bi bi-filetype-docx $size'></i>",
            self::EXE       => "<i class='bi bi-filetype-exe $size'></i>",
            self::GIF       => "<i class='bi bi-filetype-gif $size'></i>",
            self::HEIC      => "<i class='bi bi-filetype-heic $size'></i>",
            self::HTML      => "<i class='bi bi-filetype-html $size'></i>",
            self::JAVA      => "<i class='bi bi-filetype-java $size'></i>",
            self::JPG       => "<i class='bi bi-filetype-jpg $size'></i>",
            self::JS        => "<i class='bi bi-filetype-js $size'></i>",
            self::JSON      => "<i class='bi bi-filetype-json $size'></i>",
            self::JSX       => "<i class='bi bi-filetype-jsx $size'></i>",
            self::KEY       => "<i class='bi bi-filetype-key $size'></i>",
            self::M4P       => "<i class='bi bi-filetype-m4p $size'></i>",
            self::MD        => "<i class='bi bi-filetype-md $size'></i>",
            self::MDX       => "<i class='bi bi-filetype-mdx $size'></i>",
            self::MOV       => "<i class='bi bi-filetype-mov $size'></i>",
            self::MP3       => "<i class='bi bi-filetype-mp3 $size'></i>",
            self::MP4       => "<i class='bi bi-filetype-mp4 $size'></i>",
            self::OTF       => "<i class='bi bi-filetype-otf $size'></i>",
            self::PDF       => "<i class='bi bi-filetype-pdf $size'></i>",
            self::PHP       => "<i class='bi bi-filetype-php $size'></i>",
            self::PNG       => "<i class='bi bi-filetype-png $size'></i>",
            self::PPT       => "<i class='bi bi-filetype-ppt $size'></i>",
            self::PPTX      => "<i class='bi bi-filetype-pptx $size'></i>",
            self::PSD       => "<i class='bi bi-filetype-psd $size'></i>",
            self::PY        => "<i class='bi bi-filetype-py $size'></i>",
            self::RAW       => "<i class='bi bi-filetype-raw $size'></i>",
            self::RB        => "<i class='bi bi-filetype-rb $size'></i>",
            self::SASS      => "<i class='bi bi-filetype-sass $size'></i>",
            self::SCSS      => "<i class='bi bi-filetype-scss $size'></i>",
            self::SH        => "<i class='bi bi-filetype-sh $size'></i>",
            self::SQL       => "<i class='bi bi-filetype-sql $size'></i>",
            self::SVG       => "<i class='bi bi-filetype-svg $size'></i>",
            self::TIFF      => "<i class='bi bi-filetype-tiff $size'></i>",
            self::TSX       => "<i class='bi bi-filetype-tsx $size'></i>",
            self::TTF       => "<i class='bi bi-filetype-ttf $size'></i>",
            self::TXT       => "<i class='bi bi-filetype-txt $size'></i>",
            self::WAV       => "<i class='bi bi-filetype-wav $size'></i>",
            self::WOFF      => "<i class='bi bi-filetype-woff $size'></i>",
            self::XLS       => "<i class='bi bi-filetype-xls $size'></i>",
            self::XLSX      => "<i class='bi bi-filetype-xlsx $size'></i>",
            self::XML       => "<i class='bi bi-filetype-xml $size'></i>",
            self::YML       => "<i class='bi bi-filetype-yml $size'></i>",
            default         => "<i class='bi bi-file-earmark $size'></i>",
        };
    }



}
