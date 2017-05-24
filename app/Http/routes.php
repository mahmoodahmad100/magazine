<?php


// PagesController //
Route::get('/',[
  'uses' => 'PagesController@getHome',
  'as' => 'home'
]);

Route::get('{category_name}-({id})',[
  'uses' => 'PagesController@getCategory',
  'as' => 'category-dept'
]);

Route::get('bestPosts',[
  'uses' => 'PagesController@getBestPosts',
  'as' => 'bestPosts'
]);

Route::get('/create',[
  'uses' => 'PagesController@getCreate',
  'as' => 'create',
  'middleware' => 'auth'
]);

Route::get('/activities',[
  'uses' => 'PagesController@getActivities',
  'as' => 'activities',
  'middleware' => 'auth'
]);
// End PagesController //


// PanelController //
Route::get('cp',[
  'uses' => 'PanelController@getAdmin',
  'as' => 'cp',
  'middleware' => 'guest'
]);

Route::post('signincp',[
  'uses' => 'PanelController@postSignIn',
  'as' => 'signincp'
]);

Route::get('cp-index',[
  'uses' => 'PanelController@getDashboard',
  'as' => 'cp-index',
  'middleware' => 'admin'
]);

Route::post('postGeneralInfo',[
  'uses' => 'PanelController@postGeneralInfo',
  'as' => 'postGeneralInfo',
  'middleware' => 'admin'
]);

Route::get('cp-categories',[
  'uses' => 'PanelController@getCategories',
  'as' => 'cp-categories',
  'middleware' => 'admin'
]);

Route::post('addcategory',[
  'uses' => 'PanelController@postCategory',
  'as' => 'addCategory',
  'middleware' => 'admin'
]);

Route::post('editcategory',[
  'uses' => 'PanelController@postEditCategory',
  'as' => 'editCategory',
  'middleware' => 'admin'
]);

Route::get('deletecategory',[
  'uses' => 'PanelController@getDeleteCategory',
  'as' => 'deleteCategory',
  'middleware' => 'admin'
]);

Route::get('cp-users',[
  'uses' => 'PanelController@getUser',
  'as' => 'cp-users',
  'middleware' => 'admin'
]);

Route::post('makeAdmin',[
  'uses' => 'PanelController@postAdmin',
  'as' => 'makeAdmin',
  'middleware' => 'admin'
]);

Route::post('makeBan',[
  'uses' => 'PanelController@postBan',
  'as' => 'makeBan',
  'middleware' => 'admin'
]);

Route::post('makeBestPost',[
  'uses' => 'PanelController@postBestPost',
  'as' => 'makeBestPost',
  'middleware' => 'admin'
]);

Route::post('makeBlockPostOrComment',[
  'uses' => 'PanelController@postBlockPostOrComment',
  'as' => 'makeBlockPostOrComment',
  'middleware' => 'admin'
]);

Route::post('makeMsgs',[
  'uses' => 'PanelController@postMsgs',
  'as' => 'makeMsgs',
  'middleware' => 'admin'
]);

Route::get('cp-posts',[
  'uses' => 'PanelController@getPost',
  'as' => 'cp-posts',
  'middleware' => 'admin'
]);

Route::get('cp-reports',[
  'uses' => 'PanelController@getReport',
  'as' => 'cp-reports',
  'middleware' => 'admin'
]);

Route::get('cp-messages',[
  'uses' => 'PanelController@getMsg',
  'as' => 'cp-messages',
  'middleware' => 'admin'
]);
// End PanelController //


// UserController //
Route::get('/user',[
  'uses' => 'UserController@getUser',
  'as' => 'user',
  'middleware' => 'auth'
]);

Route::post('signup',[
  'uses' => 'UserController@postSignUp',
  'as' => 'signup'
]);

Route::post('signin',[
  'uses' => 'UserController@postSignIn',
  'as' => 'signin'
]);

Route::post('postChangeGeneralInfo',[
  'uses' => 'UserController@postChangeGeneralInfo',
  'as' => 'changeGeneralInfo'
]);

Route::post('postChangePassword',[
  'uses' => 'UserController@postChangePassword',
  'as' => 'changePassword'
]);

Route::get('logout',[
  'uses' => 'UserController@getLogout',
  'as' => 'logout'
]);
// End UserController //


// PostController //
Route::post('sendtopic',[
  'uses' => 'PostController@postTopic',
  'as' => 'sendtopic'
]);

Route::post('sendcomment',[
  'uses' => 'PostController@postComment',
  'as' => 'sendcomment'
]);

Route::get('/{id}-{title}{commentId?}',[
  'uses' => 'PostController@getShowPost',
  'as' => 'showPost'
]);

Route::post('postLike',[
  'uses' => 'PostController@postLike',
  'as' => 'postLike'
]);

Route::post('postReport',[
  'uses' => 'PostController@postReport',
  'as' => 'postReport'
]);

Route::post('editPost',[
  'uses' => 'PostController@postEditPost',
  'as' => 'editPost'
]);

Route::post('editComment',[
  'uses' => 'PostController@postEditComment',
  'as' => 'editComment'
]);

Route::get('deletePost',[
  'uses' => 'PostController@deletePost',
  'as' => 'deletePost'
]);

Route::get('deleteComment',[
  'uses' => 'PostController@deleteComment',
  'as' => 'deleteComment'
]);
// End PostController //
