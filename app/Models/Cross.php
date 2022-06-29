<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cross extends Model
{
    use HasFactory;

    protected $connection = 'adkulan_dev';

    protected $table = 'partners_cross';

    public const UPDATED_AT = null;
    public const CREATED_AT = null;

    protected $fillable = [
        'main_brand',
        'main_article',
        'repl_brand',
        'repl_article',
        'quality',
        'name'
    ];

    public function scopePairs($query, $articles, $substituteArticles)
    {
        //создать пару артикул-заменитель
        $combined = collect($articles)->combine($substituteArticles)->map(function ($article) {
            return mb_strtoupper($article);
        });

        $query->where(function ($q) use ($combined) {
            //Сформировать условие на выборку пар в запросе
            $combined->each(function ($article, $substituteArticle) use ($q) {
                $q->orWhere(function ($qq) use ($article, $substituteArticle) {
                    $qq->where('main_article', $article)
                        ->where('repl_article', $substituteArticle);
                });
            });
        });

        return $query;
    }

}
