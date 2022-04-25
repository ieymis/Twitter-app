<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            "is_followed" => !!$this->followers()->where('user_id', Auth::id())->first(),
            "is_following_me" => !!$this->followings()->where('following_idg', Auth::id())->first(),
            // "is_following_me" => $this->followers()->where('id', )
            // "is_foloow" => '1'

        ];
    }
}
