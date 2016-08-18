<?php

namespace G4\Repository\Adapters;

interface AdapterInterface
{

    public function delete();

    public function get();

    public function getPriority();

    public function has();

    public function put($data = []);

    public function post($data = []);

}