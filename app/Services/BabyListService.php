<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Http\Resources\BabyListResource;
use App\Models\BabyList;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class BabyListService
{
    private function babySearch($listQuery, $search = null)
    {
        if ($search) {
            $listQuery->where(function ($searchBuilder) use ($search) {
                $searchBuilder->where('name', 'like', "%{$search}%")
                    ->orWhere('contents', 'like', "%{$search}%");
            });
        }
        return $listQuery;
    }

    public function babyList(int $userId, string $search = null): AnonymousResourceCollection
    {
        $babyListQuery = User::where([
            'id' => $userId,
        ])->latest();

        return BabyListResource::collection(choicePaginate(
            $this->babySearch($babyListQuery, $search)
        ));
    }

    public function babyListStore(array $babyListData): Model|BabyList
    {
        return BabyList::create($babyListData);
    }
}
