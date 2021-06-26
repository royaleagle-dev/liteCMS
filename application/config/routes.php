<?php

$urlRoutes = array(
    'login' => 'login',
    'dashboard'=>'admin/index',
    'auth'=>'login/auth',
    'logout'=>'admin/logout',
    'post_delete'=>'admin/deletePost',
    'post_edit'=>'admin/editPost',
    'createPost' => 'admin/createPost',
    'publishPost' =>'admin/publishPost',
    'addNewTag' => 'admin/addTag',
    'draftPost' => 'admin/draftPost',
    'allPosts' => 'admin/allPosts',
    'allUsers' => 'admin/users',
    'updatePublish' => 'admin/updatePublishedPost',
    'searchPost' => 'admin/searchPost',
    'tags' => 'admin/tags',
    'tag_delete'=>'admin/deleteTag',
    'tag_detail' => 'admin/tagDetail',
    //frontend routes
    'blogPost' => 'blog/post',
);

define ("ROUTES", $urlRoutes);