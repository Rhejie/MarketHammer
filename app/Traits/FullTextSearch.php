<?php
 
namespace App\Traits;
 
trait FullTextSearch
{
 
    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @param mixed $columns
     * @param boolean $or
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term, $columns = null, $or = false, $selectRelevance = null, $mode = "IN BOOLEAN MODE")
    {
        if($columns == null){
            $columns = implode(',', $this->searchable);
        }
        $searchableTerm = $term;

        if($selectRelevance){
            $query->selectRaw("MATCH({$columns}) AGAINST(? {$mode}) AS {$selectRelevance}", [$searchableTerm]);
        }
        
        if($or){
            $query->orWhereRaw("MATCH({$columns}) AGAINST(? {$mode})" , $searchableTerm);
        }
        else{
            $query->whereRaw("MATCH({$columns}) AGAINST(? {$mode})" , $searchableTerm);
        }
 
        
 
        return $query;
    }
}