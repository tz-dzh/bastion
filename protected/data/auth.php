<?php
return array (
  'createPost' => 
  array (
    'type' => 0,
    'description' => 'создание поста',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'updatePost' => 
  array (
    'type' => 0,
    'description' => 'изменение поста',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'deletePost' => 
  array (
    'type' => 0,
    'description' => 'удаление поста',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'changeRole' => 
  array (
    'type' => 0,
    'description' => 'изменение роли пользователя',
    'bizRule' => NULL,
    'data' => NULL,
  ),
  'updateOwnPost' => 
  array (
    'type' => 1,
    'description' => 'изменение своих постов',
    'bizRule' => 'return Yii::app()->user->id==$params["post"]->author_id;',
    'data' => NULL,
    'children' => 
    array (
      0 => 'updatePost',
    ),
  ),
  'member' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'createPost',
      1 => 'updateOwnPost',
    ),
    'assignments' => 
    array (
      14 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'admin' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'children' => 
    array (
      0 => 'member',
      1 => 'updatePost',
      2 => 'deletePost',
      3 => 'changeRole',
    ),
    'assignments' => 
    array (
      2 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
  'user' => 
  array (
    'type' => 2,
    'description' => '',
    'bizRule' => NULL,
    'data' => NULL,
    'assignments' => 
    array (
      1 => 
      array (
        'bizRule' => NULL,
        'data' => NULL,
      ),
    ),
  ),
);
