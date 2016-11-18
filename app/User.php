<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  protected $fillable = ['first_name', 'last_name', 'color'];
  protected $hidden = ['pivot'];

  public static $rules = [
    'first_name' => 'required|min:3|max:80|Alpha',
    'last_name' => 'required|min:3|max:80|Alpha',
    'color' => 'required|Integer|min:0|max:11'
  ];

  public function withFriends() {
    $this->friends = $this->friends()->get();
    return $this;
  }

  public function friends() {
    return $this->belongsToMany(
      'App\User', 'friendships',
      'user_id', 'friend_id'
    );
  }

  public function addFriend(User $user) {
    if (!$this->friends->find($user)) {
      $this->friends()->attach($user->id);
      $user->friends()->attach($this->id);

      return true;
    }

    return false;
  }

  public function removeFriend(User $user) {
    if ($this->friends->find($user)) {
      $this->friends()->detach($user->id);
      $user->friends()->detach($this->id);

      return true;
    }

    return false;
  }
}

