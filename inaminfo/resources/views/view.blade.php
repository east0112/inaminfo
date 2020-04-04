<!doctype html>
<html lang="ja">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="伊波杏樹さんの出演情報をまとめた非公式ファンサイトです。"/>
<meta name="keywords" content="伊波杏樹, SMA声優 ,ファンクラブ">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.1.1/css/hover.css">
<link rel="stylesheet" href="{{ mix('/css/app.css') }}">
<script type="text/javascript" src="https://platform.twitter.com/widgets.js"></script>
<head>
    <meta charset="UTF-8">
    <title>inaminfo</title>
</head>
<body id="body">
<div id="app">
    <header-component></header-component>
    <router-view></router-view>
    <footer-component></footer-component>
</div>
</body>
<script src=" {{ mix('js/app.js') }} "></script>