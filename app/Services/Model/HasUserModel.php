<?php

namespace App\Services\Model;

use App\Models\Auth\User;
use Illuminate\Support\Str;

trait HasUserModel
{
    public function scopeOrder($query, $request)
    {
        if ($request->orderBy && $request->sortBy) {
            if (Str::contains($request->orderBy, '.')) {
                $relations = $this->getRelations();
                $ex = explode('.', $request->orderBy);

                $rel = implode('.', array_values(array_slice($ex, 0, count($ex) - 1)));
                if (isset($relations[$rel])) {
                    $relation = $relations[$rel];
                    $query = $query->join($relation['table'], $relation['table'] . '.id', '=', $this->getTable() . '.' . $relation['field']);
                    return $query->orderBy($relation['table'] . "." . $ex[count($ex) - 1], $request->sortBy);
                }
            }else if(strtolower($request->orderBy) == 'ip'){
                return $query->orderByRaw("INET_ATON(".$request->orderBy.") ".$request->sortBy);
            } else {
                return  $query->orderBy($request->orderBy, $request->sortBy);
            }
        } else {
            return  $query->orderBy('id', 'desc');
        }
    }

    public function scopePage($query, $request)
    {
        if ($request->limit) {
            $pagiation = $request->limit ?? 10;
            return  $query->paginate($pagiation);
        } else {
            return $query->get();
        }
    }

    public function scopeFilter($query, $request)
    {
        $filter = $request->filter ?? [];
        $quer = $query;
        if (count($filter) > 0) {
            foreach ($filter as $value) {
                $arrayResult = explode(',', $value);
                if (count($arrayResult) < 3) {
                    $quer = $quer->{$arrayResult[0]}($arrayResult[1]);
                } else {
                    switch ($arrayResult[2]) {
                        case 'LIKE':
                            $quer = $quer->{$arrayResult[0]}($arrayResult[1], $arrayResult[2], '%' . $arrayResult[3] . '%');
                            break;
                        default:
                            $quer = $quer->{$arrayResult[0]}($arrayResult[1], $arrayResult[2], $arrayResult[3]);
                            break;
                    }
                }
            }
            return $quer;
        }
    }

    public function scopeRelations($query, $request)
    {
        if ($request->relations) {
            $relations =
                explode(',', $request->relations);
            return $query->with($relations);
        }
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
