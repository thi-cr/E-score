<?php

abstract class AbstractController
{
    public function create()
    {
        var_dump('no create');
    }

    public function edit($id)
    {
        var_dump('no edit');
    }

    public function delete($id, $data)
    {
        var_dump('no delete');
    }

    public function show($id)
    {
        var_dump('no show');
    }

    public function update($id, $data)
    {
        var_dump('no update');
    }

    public function store($id, $data)
    {
        var_dump('no store');
    }

    public function index()
    {
        var_dump('no index');
    }

    public function add()
    {
        var_dump('no add');
    }

    public function login()
    {
        var_dump('no login');
    }


}