<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use \Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $descr;
    public $slug;
    public $date;
    public $body;

    public function __construct($title, $descr, $date, $slug, $body)
    {
        $this->title = $title;
        $this->descr = $descr;
        $this->date = $date;
        $this->slug = $slug;
        $this->body = $body;
    }

    public static function all()
    {
        $files = File::files(resource_path("views/posts/"));

        $posts = collect($files)
            ->map(function ($file) {
                return YamlFrontMatter::parseFile($file);
            })
            ->map(function ($doc) {
                return new Post(
                    $doc->title,
                    $doc->descr,
                    $doc->date,
                    $doc->slug,
                    $doc->body(),
                );
            });

        return $posts;
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
//        $path = resource_path("views/posts/{$slug}.html");
//
//        if (! file_exists($path)) {
//            throw new ModelNotFoundException();
//        }
//
//        return cache()->remember("/post/{$slug}", 10, function () use ($path) {
//            var_dump('file NOT IN cache; INSERTING to cache');
//            return file_get_contents($path);
//        });
    }
}
