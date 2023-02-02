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
        $posts = cache()->remember('posts.all', 1, function () {
//            var_dump(111);
            $files = File::files(resource_path("views/posts/"));

            return collect($files)
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
                })
                ->sortByDesc('date');
        });

        return $posts;
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
