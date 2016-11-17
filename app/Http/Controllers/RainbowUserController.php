<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\RainbowUser;

class RainbowUserController extends Controller
{
    public function index()
    {
      return RainbowUser::all();
    }

    public function store(Request $request)
    {
      $this->validate($request, RainbowUser::$rules);
      $user = RainbowUser::create($request->all());

      return response()->json($user);
    }

    public function show($id)
    {
      $user = RainbowUser::findOrFail($id);
      return $user;
    }

    public function update(Request $request, $id)
    {
      $user = RainbowUser::findOrFail($id);

      $this->validate($request, RainbowUser::$rules);
      $user->fill($request->all())->save();

      return $user;
    }

    public function destroy($id)
    {
      $user = RainbowUser::findOrFail($id);

      $user->delete();
      return response(null, 200);
    }

    public function testdata(Request $request) {
      $this->validate($request, [
        'userCount' => 'required|Integer|min:1|max:1000000'
      ]);
      DB::table('rainbow_users')->delete();
      $chars = "abcdefghijklmnopqrstuvwxyz";
      for ($i = 0; $i < $request->userCount; $i++) {
        $user = [
          'first_name' => substr($chars, rand(0, 20), 5),
          'last_name' => substr($chars, rand(0, 20), 5),
          'color' => rand(0, 11)
        ];
        RainbowUser::create($user);
      }
      //return response()->json([
        //'count' => RainbowUser::count(),
        //'users' => RainbowUser::all()->random(rand(1, RainbowUser::count()))
      //]);

      return redirect()->action('RainbowUserController@index');
    }
}
