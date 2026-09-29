<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="PMI Admin">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title> PMI Dashboard</title>


    <link rel="stylesheet"
          href="{{ asset('adminfiles/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet"
          href="{{ asset('adminfiles/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <link rel="stylesheet"
          href="{{ asset('adminfiles/assets/css/style.css') }}">

          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="admin-shell">
    <div class="sidebar-backdrop" data-sidebar-close></div>


@include('admin.include.nav')
    <div class="admin-main">

@include('admin.include.sidebar')
