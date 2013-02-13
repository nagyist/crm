<?php

namespace Oro\Bundle\GridBundle\Field;

class FieldDescriptionCollection implements \ArrayAccess, \Countable
{
    protected $elements = array();

    /**
     * @param FieldDescriptionInterface $fieldDescription
     * @return void
     */
    public function add(FieldDescriptionInterface $fieldDescription)
    {
        $this->elements[$fieldDescription->getName()] = $fieldDescription;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->elements);
    }

    /**
     * @param string $name
     * @return FieldDescriptionInterface
     * @throws \InvalidArgumentException
     */
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->elements[$name];
        }

        throw new \InvalidArgumentException(sprintf('Element "%s" does not exist.', $name));
    }

    /**
     * @param string $name
     * @return void
     */
    public function remove($name)
    {
        if ($this->has($name)) {
            unset($this->elements[$name]);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        throw new \RunTimeException('Cannot set value, use add');
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function count()
    {
        return count($this->elements);
    }

    /**
     * @param array $keys
     */
    public function reorder(array $keys)
    {
        array_unshift($keys, 'batch');
        $this->elements = array_merge(array_flip($keys), $this->elements);
    }
}
