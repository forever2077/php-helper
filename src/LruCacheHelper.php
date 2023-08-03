<?php

namespace Forever2077\PhpHelper;

class Node
{
    public $key;
    public $value;
    public $prev;
    public $next;

    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }
}

class LruCacheHelper
{
    private $size;
    private $capacity;
    private $nodeMap;
    private $head;
    private $tail;

    public function __construct($capacity)
    {
        $this->size = 0;
        $this->capacity = $capacity;
        $this->nodeMap = [];
        $this->head = new Node(null, null);
        $this->tail = new Node(null, null);
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }

    public function get($key)
    {
        if (!isset($this->nodeMap[$key])) {
            return -1;
        }
        $node = $this->nodeMap[$key];
        $this->moveToHead($node);
        return $node->value;
    }

    public function put($key, $value)
    {
        if (isset($this->nodeMap[$key])) {
            $node = $this->nodeMap[$key];
            $node->value = $value;
            $this->moveToHead($node);
        } else {
            $node = new Node($key, $value);
            $this->nodeMap[$key] = $node;
            $this->addToHead($node);
            $this->size++;
            if ($this->size > $this->capacity) {
                $removed = $this->removeTail();
                unset($this->nodeMap[$removed->key]);
                $this->size--;
            }
        }
    }

    private function addToHead($node)
    {
        $node->prev = $this->head;
        $node->next = $this->head->next;
        $this->head->next->prev = $node;
        $this->head->next = $node;
    }

    private function removeNode($node)
    {
        $node->prev->next = $node->next;
        $node->next->prev = $node->prev;
    }

    private function moveToHead($node)
    {
        $this->removeNode($node);
        $this->addToHead($node);
    }

    private function removeTail()
    {
        $node = $this->tail->prev;
        $this->removeNode($node);
        return $node;
    }
}
