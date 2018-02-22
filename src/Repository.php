<?php

namespace G4\Repository;

class Repository
{

    private $adapters = [];

    public function __construct()
    {
    }

    public function addAdapter(Adapters\AdapterInterface $adapter)
    {
        if (isset($this->adapters[$adapter->getPriority()])) {
            throw new \Exception('Change adapter priority', 409);
        }

        $this->adapters[$adapter->getPriority()] = $adapter;
        return $this;
    }

    public function delete()
    {
        $last = array_pop($this->adapters);
        $response = $last->delete();
        foreach ($this->adapters as $adapter) {
            $adapter->delete();
        }
        return $response;
    }

    public function get()
    {
        $response = null;
        $updateAdapters = [];
        foreach ($this->adapters as $adapter) {
            if ($adapter->has()) {
                $response = $adapter->get();
                break;
            }
            $updateAdapters[] = $adapter;
        }

        if (!empty($updateAdapters)) {
            $this->putToStorage($updateAdapters, $response);
        }
        return $response;
    }

    public function post($storageData = [])
    {
        $last = array_pop($this->adapters);
        $response = $last->post($storageData);
        foreach ($this->adapters as $adapter) {
            $adapter->delete();
        }
        return $response;
    }

    public function put($storageData = [])
    {
        $last = array_pop($this->adapters);
        $response = $last->put($storageData);
        foreach ($this->adapters as $adapter) {
            $adapter->delete();
        }
        return $response;
    }

    private function putToStorage($adapters, $storageData = null)
    {
        foreach ($adapters as $adapter) {
            $adapter->put($storageData);
        }
        return $this;
    }
}
