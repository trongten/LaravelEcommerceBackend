<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Auth;

class Todo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
      'title',
      'content',
      'user_id',
    ];

    /**
     * Get all todo
     */
    public static function list() {
      return Todo::orderBy('created_at', 'desc')->get();
    }

    /**
     * Crate a todo
     *  @param  \Illuminate\Http\Request  $request
     */
    public static function store(Request $request) {
      return Todo::create([
        'title' => $request->title,
        'content' => $request->content,
        'user_id' => Auth::id()
      ]);
    }

    /**
     * Update a todo
     *  @param  \Illuminate\Http\Request  $request
     *  @param  Int  $id
     */
    public static function updateById(Request $request, $id) {
      $todo = Todo::find($id);
 
      $todo->title = $request->title;
      $todo->content = $request->content;
       
      return $todo->save();
    }

    /**
     * Delete a todo by id
     * @param  Int  $id
     */
    public static function deleteById($id) {
      return Todo::destroy($id);
    }

    /**
     * Get a todo by id
     * @param  Int  $id
     */
    public static function getById($id) {
      return Todo::find($id);
    }

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
