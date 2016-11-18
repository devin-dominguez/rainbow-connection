<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use \Illuminate\Database\Eloquent\Factory;

class UserController extends Controller {

  public function __construct() {
    $this->middleware('cors');
  }

  public function index(Request $request) {
    $page = User::with('friends')->paginate(50)->toArray();
    return response()->json([
      'meta' => [
        'total' => $page['total'],
        'per_page' => $page['per_page'],
        'current_page' => $page['current_page'],
        'last_page' => $page['last_page']
      ],
      'users' => $page['data']
    ]);
  }

  public function store(Request $request) {
    $this->validate($request, User::$rules);
    $user = User::create($request->all());

    return response(null, 200);
  }

  public function show($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json([
        'error' => 'user not found'
      ], 404);
    }
    return response()->json([
      'user' =>$user->withFriends()
    ]);
  }

  public function update(Request $request, $id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json([
        'error' => 'user not found'
      ], 404);
    }

    $this->validate($request, User::$rules);

    $friendsToAdd = User::findMany($request->addFriends);
    forEach ($friendsToAdd as $friend) {
    $user->addFriend($friend);
    }

    $friendsToRemove = User::findMany($request->removeFriends);
    forEach ($friendsToRemove as $friend) {
    $user->removeFriend($friend);
    }

    $user->fill($request->all())->save();

    return response(null, 200);
  }

  public function destroy($id) {
    $user = User::find($id);
    if (!$user) {
      return response()->json([
        'error' => 'user not found'
      ], 404);
    }

    $user->delete();
    return response(null, 200);
  }

  public function testdata(Request $request) {
    $this->validate($request, [
      'userCount' => 'required|Integer|min:1|max:1000000'
    ]);

    DB::table('users')->delete();
    DB::table('friendships')->delete();

    $userCount = $request->userCount;
    $users = factory(User::class, $userCount)->create();
    $maxFriends = min(50, $userCount);

    $userList = $users->all();
    $friendsCount = array_fill(0, $userCount, 0);

    // semi-wonky connection generator
    $friendChance = 25;

    for ($i = 0; $i < $userCount; $i++) {
      while ($friendsCount[$i] < $maxFriends && rand(0, 100) < $friendChance) {
        $friendIdx = rand(0, $userCount - 1);
        if ($i != $friendIdx && $friendsCount[$friendIdx] < $maxFriends) {
          $friendsCount[$friendIdx]++;
          $friendsCount[$i]++;
          $user = $userList[$i];
          $userList[$i]->addFriend($userList[$friendIdx]);
        }
      }
    }

    return redirect()->action('UserController@index');
  }
}
