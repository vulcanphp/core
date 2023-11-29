<?php

namespace VulcanPhp\Core\Helpers;

class Bucket
{
    public static Bucket $store;

    public array $data = [];

    public function __construct()
    {
        self::$store = $this;
    }

    public function has(string $type, $key = null): bool
    {
        return $key !== null
            ? isset($this->data[$type][$key]) && !empty($this->data[$type][$key])
            : isset($this->data[$type]) && !empty($this->data[$type]);
    }

    public function set(string $type, $value, $key = null): self
    {
        $key !== null
            ? $this->data[$type][$key] = $value
            : $this->data[$type] = $value;

        return $this;
    }

    public function push(string $type, $value, $key = null): self
    {
        if (!isset($this->data[$type])) {
            $this->data[$type] = [];
        }

        if ($key !== null && !isset($this->data[$type][$key])) {
            $this->data[$type][$key] = [];
        }

        $key !== null
            ? array_push($this->data[$type][$key], $value)
            : array_push($this->data[$type], $value);

        return $this;
    }

    public function unshift(string $type, $value, $key = null): self
    {
        if (!isset($this->data[$type])) {
            $this->data[$type] = [];
        }

        $key !== null
            ? array_unshift($this->data[$type][$key], $value)
            : array_unshift($this->data[$type], $value);

        return $this;
    }

    public function pop(string $type, $key = null)
    {
        return $key !== null
            ? array_pop($this->data[$type][$key])
            : array_pop($this->data[$type]);
    }

    public function shift(string $type, $key = null)
    {
        return $key !== null
            ? array_shift($this->data[$type][$key])
            : array_shift($this->data[$type]);
    }

    public function get(string $type, $key = null, $default = null)
    {
        return $key !== null
            ? ($this->data[$type][$key] ?? $default)
            : ($this->data[$type] ?? $default);
    }

    public function is(...$args): bool
    {
        return boolval($this->get(...$args)) === true;
    }

    public function last(string $type, $key = null)
    {
        return $key !== null
            ? Arr::last($this->data[$type][$key])
            : Arr::last($this->data[$type]);
    }

    public function first(string $type, $key = null)
    {
        return $key !== null
            ? Arr::first($this->data[$type][$key])
            : Arr::first($this->data[$type]);
    }

    public function load(string $type, $callback, $key = null)
    {
        return $key !== null
            ? ($this->data[$type][$key] ??= call_user_func($callback))
            : ($this->data[$type] ??= call_user_func($callback));
    }

    public function remove(string $type, $key = null): self
    {
        if ($key !== null) {
            unset($this->data[$type][$key]);
        } else {
            unset($this->data[$type]);
        }

        return $this;
    }
}
